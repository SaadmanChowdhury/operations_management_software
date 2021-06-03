<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'project_id';

    protected $guarded = [];

    public function readProjectList()
    {
        $project = DB::table('projects')
            ->select([
                'project_id as projectID',
                'project_id as projectCode',
                'project_name as projectName',
                'client_id as clientID',
                'manager_id as projectLeaderID',

                'order_status as orderStatus',
                'business_situation as businessSituation',
                'development_stage as developmentStage',
                'order_month as orderMonth',
                'inspection_month as inspectionMonth',
                'sales_total as salesTotal',
                'transferred_amount as transferredAmount',
                'budget as budget',
                // 'cost_of_sales as costOfSales',
                'remarks',
                'active_status as isActive',
            ])
            ->whereNull("deleted_at")
            ->get();

        return $project;
    }

    public function createProject($validatedData)
    {
        //saving new record
        $project = DB::table('projects')->insertGetId([
            'project_name' => $validatedData['project_name'],
            'client_id' => $validatedData['client_id'],
            'manager_id' => $validatedData['manager_id'],
            'order_month' => $validatedData['order_month'],
            'inspection_month' => $validatedData['inspection_month'],
            'order_status' => $validatedData['order_status'],
            'business_situation' => $validatedData['business_situation'],
            'development_stage' => $validatedData['development_stage'],
            'sales_total' => $validatedData['sales_total'],
            'transferred_amount' => $validatedData['transferred_amount'],
            'budget' => $validatedData['budget'],
        ]);
        return ['projectID' => $project];
    }

    public function convertOrderStatusToInt($sentStatus)
    {
        $allStatus = config('constants.Order_Status');
        foreach ($allStatus as $status => $intStatus) {
            if ($status == $sentStatus) {
                return $intStatus;
            }
        }
    }

    public function convertBusinessSituationToInt($sentSituation)
    {
        $allSituation = config('constants.Business_situation');
        foreach ($allSituation as $situation => $intSituation) {
            if ($situation == $sentSituation) {
                return $intSituation;
            }
        }
    }

    public function convertDevelopmentStageToInt($sentStage)
    {
        $allStage = config('constants.Development_stage');
        foreach ($allStage as $stage => $intStage) {
            if ($stage == $sentStage) {
                return $intStage;
            }
        }
    }

    public function readProject($id)
    {
        $project = Project::select([
            'project_id as projectID',
            'project_id as projectCode',
            'project_name as projectName',
            'client_id as clientID',
            'manager_id as projectLeaderID',

            'order_status as orderStatus',
            'business_situation as businessSituation',
            'development_stage as developmentStage',
            'order_month as orderMonth',
            'inspection_month as inspectionMonth',
            'sales_total as salesTotal',
            'transferred_amount as transferredAmount',
            'budget as budget',
            // 'cost_of_sales as costOfSales',
            'remarks',
            'active_status as isActive',
        ])->where('project_id', $id)
            ->whereNull("deleted_at")
            ->first();

        return $project;
    }

    public function upsertProjectDetails($request)
    {
        $project = Project::updateOrCreate(
            ['project_id' => $request->projectID],
            [
                'project_ode' => $request->projectCode,
                'project_name' => $request->projectName,
                'client_id' => $request->clientID,
                'manager_id' => $request->projectLeaderID,
                'businessSituation  ' => $request->businessSituation,
                'developmentStage' => $request->developmentStage,
                'inspectionMonth ' => $request->inspectionMonth,
                'transferredAmount' => $request->transferredAmount,
                'budget' => $request->budget,
                'salesDepartment' => $request->salesDepartment,
                'costOfSales' => $request->costOfSales,
                'remarks' => $request->remarks,
            ]
        );

        return $project->project_id;
    }



    public function deleteProject($id)
    {
        $project = Project::find($id);
        //soft delete
        $project->delete();
    }


    /**
     * this will return the total plan_man_month value for a stuff of the project
     */
    public function getIndividualTotalPlanManMonth($project_id, $user_id)
    {
        $data = DB::table('assign')
            ->where('assign.project_id', $project_id)
            ->where('assign.user_id', $user_id)
            ->whereNull("deleted_at")
            ->sum('assign.plan_man_month');
        return $data;
    }

    /**
     * get total man-month of a project
     */
    public function getTotalManMonth($project_id)
    {
        $data = DB::table('assign')
            ->where('assign.project_id', $project_id)
            ->whereNull("deleted_at")
            ->sum('assign.plan_man_month');
        return $data;
    }

    /**
     * get total man-hours of a project
     */
    public function getTotalManHours($project_id)
    {
        //getting the total man-month
        $totalManMonth = $this->getTotalManMonth($project_id);

        //converting man-month to man-hours
        $totalManHours = intval($totalManMonth) * 22 * 8;

        return $totalManHours;
    }

    public function getAssignUsersId($project_id)
    {
        $data = DB::table('assign')
            ->select('user_id')
            ->where('project_id', $project_id)
            ->groupBy('user_id')
            ->get();
        return $data;
    }

    public function getUserSalary($user_id)
    {
        $salaryModel = new Salary();
        return $salaryModel->getLatestSalary($user_id);
    }

    public function getProjectCost($project_id)
    {
        $assignedUsersId = $this->getAssignUsersId($project_id);
        $totalCost = 0;
        foreach ($assignedUsersId as $user) {
            $user_id = $user->user_id;
            $individualPlanManMonth = $this->getIndividualTotalPlanManMonth($project_id, $user_id);
            $salary = $this->getUserSalary($user_id);
            $totalCost += $individualPlanManMonth * $salary;
        }

        return $totalCost;
    }

    public function getProjectBudget($project_id)
    {
        $project = Project::select('budget')->where('project_id', $project_id)->first();
        return $project->budget;
    }

    public function getProjectProfit($project_id)
    {
        $projectBudget = $this->getProjectBudget($project_id);
        $projectCost = $this->getProjectCost($project_id);

        $projectProfit = intval($projectBudget) - intval($projectCost);

        return $projectProfit;
    }

    /**
     * this method returns the project profit percentage
     *
     * @param [int] $project_id
     * @return int
     */
    public function getProjectProfitPercentage($project_id)
    {
        $projectProfit = $this->getProjectProfit($project_id);
        $projectBudget = $this->getProjectBudget($project_id);

        // if the budget is zero then it should return 0
        if ($projectBudget == 0) {
            return 0;
        }

        $profitPercentage = $projectProfit * 100 / $projectBudget;

        $profitPercentage = number_format((float)$profitPercentage, 2, '.', '');

        return $profitPercentage;
    }


    public function getProjectAssignDetails($projectID)
    {
        return Assign::where('project_id', $projectID)->get();
    }

    public function getProjectData($projectID)
    {
        return DB::table('projects')
            ->select(
                'project_id as projectID',
                'manager_id as projectLeaderID',
                'budget as budget',
                'order_month as orderMonth',
                'inspection_month as inspectionMonth',
            )
            ->where('projects.project_id', $projectID)
            ->whereNull("deleted_at")->first();
    }

    public function getProjectLeaderID($projectID)
    {
        // returning project leader id
        $project = Project::where('project_id', $projectID)->first();
        return $project->manager_id;
    }

    public function changeActiveStatus($item_id, $active_status)
    {
        return DB::table('projects')
            ->where('project_id', $item_id)
            ->update(['active_status' => $active_status]);
    }

    public function deleteProjectIfUserIsLeader($user_id)
    {
        DB::table('projects')->where('manager_id', $user_id)
            ->whereNull('deleted_at')
            ->update(['deleted_at' => Carbon::now()]);
    }
}
