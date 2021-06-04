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
        $newArray = [];
        $projectModel  = new Project;
        // Step 2
        $array = $projectModel->readProjectList();

        // getting the profit percentage for each project
        foreach ($array as $key => $value) {
            $value->profitPercentage = $projectModel->getProjectProfitPercentage($value->projectID);
            array_push($newArray, $value);
        }

        // Step 3
        $array = $this->helper_fetchProjectList($newArray);

        // Step 4 and 5
        return $this->arrayFormatting_fetchProjectList($array);
    }

    public function readProjectDetails($projectID)
    {
        $projectModel  = new Project;
        // getting the project data
        $project = $projectModel->readProject($projectID);
        // get the project ID
        $projectId = ($project->projectID);
        // get the project profit
        $project->profit = $projectModel->getProjectProfit($projectId);

        $loggedUser = auth()->user();
        //if admin or manager
        if ($loggedUser->user_authority == 'システム管理者' || $loggedUser->user_id == $project->projectLeaderID) {
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
            $data = $projectModel->createProject($validatedData);

            return $data;
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
                return '検収月は受注月を超えることはできません!!';
            }
        }

        $budget = $validatedData['budget'];
        $salesTotal = $validatedData['sales_total'];
        $transferredAmount = $validatedData['transferred_amount'];

        // the monitory values cannot be negative
        if (intval($budget) < 0) {
            return '予算を負の値にすることはできません';
        }
        if (intval($salesTotal) < 0) {
            return '売上高 に負の値は指定できません';
        }
        if (intval($transferredAmount) < 0) {
            return '振込金額は負の値にはできません';
        }

        // transferredAmount cannot be greater than salesTotal
        if (intval($transferredAmount) > intval($salesTotal)) {
            return '振込金額は売上高を超えることはできません';
        }
        return true;
    }

    public function upsertProjectDetails($request, $projectID)
    {
        $projectModel  = new Project;
        $assignModel  = new Assign();

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
                return $result;
            }

            // need to hard delete any assign which are outside the new inspect/order date range
            // delete all the assign values before the order date if inspection date is null

            $orderDate = $validatedData['order_month'];
            $orderYear = Carbon::parse($orderDate)->format('Y');
            $orderMonth = Carbon::parse($orderDate)->format('m');

            $inspectionMonth = $validatedData['inspection_month'];
            if ($inspectionMonth != null) {
                $inspectionYear = Carbon::parse($inspectionMonth)->format('Y');
                $inspectionMonth = Carbon::parse($inspectionMonth)->format('m');
            } else {
                $inspectionYear = $inspectionMonth =  null;
            }

            $assignModel->deleteAllAssignValuesOutsideProjectTimeline($orderYear, $orderMonth, $inspectionYear, $inspectionMonth, $projectID);

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
        $loggedUser = auth()->user();
        $projectModel  = new Project;
        $assignModel  = new Assign;

        $data['project'] = $projectModel->getProjectData($projectID);

        // non-admin and non-leader are not allowed to see budget, cost, profit of the project
        if (
            $loggedUser->user_authority !=  'システム管理者' &&
            $loggedUser->user_id != $data['project']->projectLeaderID
        ) {
            $data['project']->budget = null;
            $data['project']->cost = null;
            $data['project']->profit = null;
            $data['project']->profitPercentage = null;
        }

        // only admin and leader will get these information
        if (
            $loggedUser->user_authority ==  'システム管理者' ||
            $loggedUser->user_id == $data['project']->projectLeaderID
        ) {
            $data['project']->cost = $projectModel->getProjectCost($projectID);
            $data['project']->profit = $projectModel->getProjectProfit($projectID);
            $data['project']->profitPercentage = $projectModel->getProjectProfitPercentage($projectID);
        }

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
        $loggedUser = auth()->user();
        $assignModel  = new Assign;
        $projectModel  = new Project;

        $data = $request->all();
        $firstCell = $data['assignments'][0];
        $projectID = $firstCell['projectID'];

        //getting project leader ID
        $projectLeaderID = $projectModel->getProjectLeaderID($projectID);

        // if the user is nether admin nor the leader of the project
        if (
            $loggedUser->user_authority !=  'システム管理者' &&
            $loggedUser->user_id != $projectLeaderID
        ) {
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
        }

        //for testing getting the dummy data
        // $data = $this->getUpsertAssignData();
        $formattedData = $this->getFormattedDataForUpsertAssign($data);

        // if the assign value does not contains any negative value
        // or the assign value is not greater than 1
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
            if (floatval($value['value']) < 0 || floatval($value['value']) > 1) {
                $formattedData['hasNoNegativeAssignValue'] = false;
            }
        }
        return $formattedData;
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
