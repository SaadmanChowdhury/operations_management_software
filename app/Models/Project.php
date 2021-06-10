<?php

namespace App\Models;

use App\Http\Utilities\JSONHandler;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'project_id';

    protected $fillable = [
        'project_name',
        'client_id',
        'manager_id',
        'order_month',
        'inspection_month',
        'order_status',
        'business_situation',
        'development_stage',
        'sales_total',
        'transferred_amount',
        'budget',
    ];

    public function readProjectList()
    {
        $project = DB::table('projects')
            ->select([
                DB::raw('project_id AS projectID'),
                DB::raw('project_name AS projectName'),
                DB::raw('client_id AS clientID'),
                DB::raw('manager_id AS projectLeaderID'),
                DB::raw('order_month AS orderMonth'),
                DB::raw('inspection_month AS inspectionMonth'),
                DB::raw('order_status AS orderStatus'),
                DB::raw('business_situation AS businessSituation'),
                DB::raw('development_stage AS developmentStage'),
                DB::raw('sales_total AS salesTotal'),
                DB::raw('transferred_amount AS transferredAmount'),
                DB::raw('budget AS budget'),
            ])
            ->whereNull("deleted_at")
            ->get()->toArray();

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
        return [
            'projectID' => $project,
            'profit' => $this->getProjectProfitPercentage($project),
        ];
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
            'project_name as projectName',
            'client_id as clientID',
            'manager_id as projectLeaderID',

            'order_month as orderMonth',
            'inspection_month as inspectionMonth',
            'order_status as orderStatus',
            'business_situation as businessSituation',
            'development_stage as developmentStage',
            'sales_total as salesTotal',
            'transferred_amount as transferredAmount',
            'budget as budget',
        ])->where('project_id', $id)
            ->whereNull("deleted_at")
            ->first();

        return $project;
    }

    public function upsertProjectDetails($validatedData, $projectID)
    {
        $project = Project::updateOrCreate(['project_id' => $projectID], $validatedData);
        return ['projectID' => $project->project_id];
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

    public function getUserUnitPrice($user_id)
    {
        $user = User::select('unit_price')->where('user_id', $user_id)->first();
        return $user->unit_price;
    }

    public function getProjectCost($project_id)
    {
        $assignedUsersId = $this->getAssignUsersId($project_id);
        $totalCost = 0;
        foreach ($assignedUsersId as $user) {
            $user_id = $user->user_id;
            $individualPlanManMonth = $this->getIndividualTotalPlanManMonth($project_id, $user_id);
            $unit_price = $this->getUserUnitPrice($user_id);
            $totalCost += $individualPlanManMonth * $unit_price;
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
}
