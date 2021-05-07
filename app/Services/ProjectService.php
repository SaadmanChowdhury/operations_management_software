<?php

namespace App\Services;

use App\Http\Utilities\JSONHandler;
use App\Models\Assign;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProjectService
{

    protected $projectModel;

    public function __construct(Project $projectModel)
    {
        $this->$projectModel = $projectModel;
    }

    /** For our implementation of the Project List, different types of users will receive different data */
    /** i.e.
     *      1. Admin will receive all data,
     *      2. General Users will receive all data EXCEPT for monetary information
     *      3. General Users who are assigned as project leader in projects, will receive monetary information for those specific projects
     */
    /**
     * I know of two approaches to implementing these scenarios.
     *
     * ------------------
     * DEDUCTIVE APPROACH
     * ------------------
     * 1. In the Model layer, write a query which returns ALL data about ALL projects
     * 2. Call this query
     * 3. Check user's authority
     *      2.1. If user is admin, skip to step 4
     *      2.2. Else, go over each project and deduct monetary information if the user is not the assigned leader
     * 5. Rearrange data to satisfy API format
     * 6. Return array to Controller
     *
     *
     * -------------------
     * INCLUSIVE APPROACH
     * -------------------
     * 1. In the Model layer, write two queries:
     *      Query A : returns ALL NON-monetary data about ALL projects
     *      Query B : returns only monetary data about a 1 specific project
     *
     * 2. Call query A
     * 3. Check user's authority, and iterate for each project
     *      3.1. If user is admin or assigned leader, call query B on that project
     *      3.2. Else, check next project
     * 4. Rearrange data to satisfy API format
     * 5. Return array to Controller
     *
     */

    /**
     * Things to note:
     * The deductive approach is easier to implement,
     * But the inclusive approach is faster when implemented with row based RDMS like MySQL or SQLite.
     * This is not Google or anything, so feel free to go for the Deductive Approach,
     * we can always update the query to be inclusive when there are over a million projects lol.
     */
    public function fetchProjectList()
    {

        $projectModel  = new Project;
        // Step 2
        $array = $projectModel->readProjectList();

        // Step 3
        $array = $this->helper_fetchProjectList($array);

        // Step 4 and 5
        return $this->arrayFormatting_fetchProjectList($array);
    }

    public function readProjectDetails($projectID)
    {
        $projectModel  = new Project;
        // getting the project data
        $project = $projectModel->readProject($projectID);

        $loggedUser = auth()->user();
        //if admin or manager
        if ($loggedUser->user_authority == 'システム管理者' || $loggedUser->user_id == $project->manager_id) {
            return $project;
        }
        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
    }

    public function createProject($request)
    {
        $projectModel  = new Project;

        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == 'システム管理者') {
            $validatedData = $request->validated();

            //formatting data for creating project
            $validatedData = $this->formatDataToCreateOrUpdate($request);

            // if all the logic passed then project can be create of update
            $result = $this->logicForUpSertProject($validatedData);
            // dd($result);

            // has some logical error
            if ($result !== true) {
                return JSONHandler::errorJSONPackage($result);
            }

            // creating a project
            $projectModel->createProject($validatedData);

            return JSONHandler::emptySuccessfulJSONPackage();
        }
        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
    }

    private function logicForUpSertProject($validatedData)
    {
        $orderMonth = $validatedData['order_month'];
        $inspectionMonth = $validatedData['inspection_month'];

        //checking the inspection_month is greater than order_month
        if ($orderMonth != null && $inspectionMonth != null) {
            $om = Carbon::createFromFormat('Y-m-d',  $orderMonth);
            $im = Carbon::createFromFormat('Y-m-d',  $inspectionMonth);
            if ($om > $im) {
                return 'Inspection Month cannot be greater than Oder Month';
            }
        }

        $budget = $validatedData['budget'];
        $salesTotal = $validatedData['sales_total'];
        $transferredAmount = $validatedData['transferred_amount'];

        // the monitory values cannot be negative and
        // sales_total and transferred_amount cannot be greater than budget
        if ($salesTotal != null) {
            if (intval($salesTotal) < 0) {
                return 'salesTotal cannot be negative';
            } elseif (intval($salesTotal) > intval($budget)) {
                return 'salesTotal cannot be greater than budget';
            }
        }
        if ($transferredAmount != null) {
            if (intval($transferredAmount) < 0) {
                return 'transferredAmount cannot be negative';
            } elseif (intval($transferredAmount) > intval($budget)) {
                return 'transferredAmount cannot be greater than budget';
            }
        }
        return true;
    }

    public function upsertProjectDetails($request, $projectID)
    {
        $projectModel  = new Project;

        $validatedData = $request->validated();
        $loggedUser = auth()->user();
        $project = $managerID = null;

        if ($projectID != null) {
            $project = Project::find($projectID);
            $managerID = $project->managerID;
        }
        //only admin and manager can update the project
        if ($loggedUser->user_authority == 'システム管理者' || $loggedUser->user_id == $managerID) {

            $validatedData = $this->formatDataToCreateOrUpdate($request);

            // if all the logic passed then project can be create of update
            $result = $this->logicForUpSertProject($validatedData);

            // has some logical error
            if ($result !== true) {
                return JSONHandler::errorJSONPackage($result);
            }

            return $projectModel->upsertProjectDetails($validatedData, $projectID);
        }
    }

    public function formatDataToCreateOrUpdate($data)
    {
        $formattedData = [];
        $formattedData['project_name'] = $data['projectName'];
        $formattedData['client_id'] = $data['clientID'];
        $formattedData['manager_id'] = $data['projectLeaderID'];
        $formattedData['order_status'] = $data['orderStatus'];
        $formattedData['business_situation'] = $data['businessSituation'];
        $formattedData['development_stage'] = $data['developmentStage'];
        $formattedData['order_month'] = $data['orderMonth'];
        $formattedData['inspection_month'] = $data['inspectionMonth'];
        $formattedData['sales_total'] = $data['salesTotal'];
        $formattedData['transferred_amount'] = $data['transferredAmount'];
        $formattedData['budget'] = $data['budget'];

        return $formattedData;
    }

    private function helper_fetchProjectList($array)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == 'システム管理者') {
            // take your decision
            return $array;
        }

        for ($i = 0; $i < count($array); $i++) {
            // If user is not project leader [General user]
            if ($array[$i]->projectLeaderID != $loggedUser->user_id) {
                // unset($array[$i]->salesTotal);
                // unset($array[$i]->transferredAmount);
                // unset($array[$i]->budget);
                $array[$i]->salesTotal = '';
                $array[$i]->transferredAmount = '';
                $array[$i]->budget = '';
            }
        }

        return $array;
    }

    private function arrayFormatting_fetchProjectList($array)
    {
        $formattedArray['project'] = $array;

        return $formattedArray;
    }

    public function readProjectAssign($projectID)
    {
        $projectModel  = new Project;
        $assignModel  = new Assign;
        $data['project'] = $projectModel->getProjectData($projectID);
        $data['project']->cost = $projectModel->getProjectCost($projectID);
        $data['project']->profit = $projectModel->getProjectProfit($projectID);
        $data['project']->profitPercentage = $projectModel->getProjectProfitPercentage($projectID);
        $data['project']->totalManMonth = $projectModel->getTotalManMonth($projectID);

        $data['project']->member = $assignModel->getMemberId($projectID);

        //for looping
        // $count = $assignModel->getCountOfMembers($projectID);
        $count = count($data['project']->member);

        for ($i = 0; $i < $count; $i++) {
            $user = $data['project']->member[$i];
            $memberID = $user->memberID;
            $data['project']->member[$i]->assign = $assignModel->getAssignInfo($projectID, $memberID);
        }

        return $data;
    }

    public function getProjectAssignDetails($projectID)
    {
        $projectModel  = new Project;
        $array = $projectModel->getProjectAssignDetails($projectID);

        return $array;
    }

    public function upsertAssign($request)
    {
        $assignModel  = new Assign;

        $data = $request->all();

        //for testing getting the dummy data
        // $data = $this->getUpsertAssignData();
        $formattedData = $this->getFormattedDataForUpsertAssign($data);

        // if the assign value does not contains any negative value
        if ($formattedData['hasNoNegativeAssignValue']) {
            // unset the non-required field to save the data 
            unset($formattedData['hasNoNegativeAssignValue']);
            // upSert the assign value
            return $assignModel->upsertAssign($formattedData);
        }
        // upSert has negative value
        $errorMessage = 'Assign contains negative assign value';
        return JSONHandler::errorJSONPackage($errorMessage);
    }

    public function getFormattedDataForUpsertAssign($data)
    {
        $formattedData = [];
        $formattedData['hasNoNegativeAssignValue'] = true;
        foreach ($data['assignments'] as $key => $value) {
            $formattedData[$key]['assign_id'] = $value['assignID'];
            $formattedData[$key]['project_id'] = $value['projectID'];
            $formattedData[$key]['user_id'] = $value['memberID'];
            $formattedData[$key]['year'] = $value['year'];
            $formattedData[$key]['month'] = $value['month'];
            $formattedData[$key]['plan_man_month'] = $value['value'];
            if (floatval($value['value']) < 0) {
                $formattedData['hasNoNegativeAssignValue'] = false;
            }
        }
        return $formattedData;
    }

    public function getUpsertAssignData()
    {
        return [
            0 => [
                'assignID' => 1,
                'projectID' => 1,
                'memberID' => 2,
                'year' => 2,
                'month' => 2,
                'value' => 2,
            ],
            1 => [
                'assignID' => 89,
                'projectID' => 1,
                'memberID' => 1,
                'year' => 1,
                'month' => 1,
                'value' => 1,
            ],
        ];
    }

    public function deleteProject($id)
    {
        $projectModel  = new Project;
        $loggedUser = auth()->user();
        $project = $projectModel->readProject($id);

        //if admin or manager
        if ($loggedUser->user_authority == 'システム管理者' || $loggedUser->user_id == $project->projectLeaderID) {
            $projectModel->deleteProject($id);

            return JSONHandler::emptySuccessfulJSONPackage();
        }
        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
    }
}
