<?php

namespace App\Services;

use App\Models\Assign;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
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
        $array = $projectModel->readProject($projectID);

        return $array;
    }

    public function upsertProjectDetails($request, $projectID)
    {
        $projectModel  = new Project;

        $validatedData = $request->validated();
        $loggedUser = auth()->user();
        $project = $manager_id = null;

        if ($projectID != null) {
            $project = Project::find($projectID);
            $manager_id = $project->manager_id;
        }
        //only admin and manager can update the project
        if (
            $loggedUser->user_authority == config('User_authority.システム管理者') ||
            $loggedUser->user_id == $manager_id
        ) {

            $validatedData = $this->formatDataToCreateOrUpdate($validatedData);

            return $projectModel->upsertProjectDetails($validatedData, $projectID);
        }
    }

    public function formatDataToCreateOrUpdate($data)
    {
        $formattedData = [];
        $formattedData['project_name'] = $data['projectName'];
        $formattedData['client_id'] = $data['clientID'];
        $formattedData['manager_id'] = $data['managerID'];
        $formattedData['sales_total'] = $data['salesTotal'];
        return $formattedData;
    }

    private function helper_fetchProjectList($array)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            // take your decision
            return $array;
        }

        for ($i = 0; $i < count($array); $i++) {
            // If user is not project leader [General user]
            if ($array[$i]->projectLeaderID != $loggedUser->user_id) {
                unset($array[$i]->salesTotal);
                unset($array[$i]->transferredAmount);
                unset($array[$i]->budget);
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
        $data['project']->member = $assignModel->getMemberId($projectID);

        //for looping
        $count = $assignModel->getCountOfMembers($projectID);

        for ($i = 0; $i < $count - 1; $i++) {
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
}
