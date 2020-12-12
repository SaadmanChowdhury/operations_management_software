<?php

namespace App\Models;

use App\Http\Utilities\JSONHandler;
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

    public function createProject($request)
    {
        Log::debug($request);
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $validatedData = $request->validated();

            $validatedData['order_status'] = $this->convertOrderStatusToInt($request->order_status);
            $validatedData['business_situation'] = $this->convertBusinessSituationToInt($request->business_situation);
            $validatedData['development_stage'] = $this->convertDevelopmentStageToInt($request->development_stage);
            //saving new record
            Project::create($validatedData);
            return JSONHandler::emptySuccessfulJSONPackage();
        }
        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
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
        $loggedUser = auth()->user();
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
        //if admin or manager
        if (
            $loggedUser->user_authority == config('User_authority.システム管理者') ||
            $loggedUser->user_id == $project->manager_id
        ) {
            return JSONHandler::packagedJSONData($project);
        }
        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
    }

    public function upsertProjectDetails($request, $projectID)
    {
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

            //updating record
            Project::updateOrCreate(['project_id' => $projectID], $validatedData);

            return JSONHandler::emptySuccessfulJSONPackage();
        }

        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
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

    public function deleteProject($id)
    {
        $loggedUser = auth()->user();
        $project = Project::find($id);

        //if admin or manager
        if (
            $loggedUser->user_authority == config('User_authority.システム管理者') ||
            $loggedUser->user_id == $project->manager_id
        ) {
            //soft delete
            $project->delete();
            return JSONHandler::emptySuccessfulJSONPackage();
        }
        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
    }


    /**
     * this will return the total execution value for a stuff of the project
     */
    public function getIndividualTotalExecution($project_id, $user_id)
    {
        $data = DB::table('assign')
            ->where('assign.project_id', $project_id)
            ->where('assign.user_id', $user_id)
            ->whereNull("deleted_at")
            ->sum('assign.execution');
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
            ->sum('assign.execution');
        return $data;
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
            $individualExecution = $this->getIndividualTotalExecution($project_id, $user_id);
            $unit_price = $this->getUserUnitPrice($user_id);
            $totalCost += $individualExecution * $unit_price;
        }

        return $totalCost;
    }

    public function getProjectBudget($project_id)
    {
        $project = Project::select('sales_total')->where('project_id', $project_id)->first();
        return $project->sales_total;
    }

    public function getProjectProfit($project_id)
    {
        $projectBudget = $this->getProjectBudget($project_id);
        $projectCost = $this->getProjectCost($project_id);

        $projectProfit = intval($projectBudget) - intval($projectCost);

        return $projectProfit;
    }

    /**
     * The users that belong to the project.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'assign', 'project_id', 'user_id');
    }

    /**
     * Get the client of the project.
     */
    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id', 'client_id');
    }
}
