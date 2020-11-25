<?php

namespace App\Models;

use App\Http\Utilities\JSONHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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
        $project = DB::table('projects')->select([
            'project_id',
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
        ])->whereNull("deleted_at")->get()->toArray();

        return $project;
    }

    public function createProject($request)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $validatedData = $request->validate([
                'project_name' => 'required',
                'client_id' => 'required',
                'manager_id' => 'required',
                'order_month' => '',
                'inspection_month' => '',
                'order_status' => '',
                'business_situation' => '',
                'development_stage' => '',
                'sales_total' => 'required',
                'transferred_amount' => '',
            ]);

            //saving new record
            Project::create($validatedData);
            return JSONHandler::emptySuccessfulJSONPackage();
        }
        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
    }

    public function readProject($id)
    {
        $loggedUser = auth()->user();
        $project = Project::select([
            'project_id',
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

    public function updateProject($request, $project_id)
    {
        //validation rules
        $rules = [
            'project_name' => 'required',
            'client_id' => 'required',
            'manager_id' => 'required',
            'order_month' => '',
            'inspection_month' => '',
            'order_status' => '',
            'business_situation' => '',
            'development_stage' => '',
            'sales_total' => 'required',
            'transferred_amount' => '',
        ];

        $loggedUser = auth()->user();
        $project = Project::find($project_id);

        //only admin and manager can update the project
        if (
            $loggedUser->user_authority == config('User_authority.システム管理者') ||
            $loggedUser->user_id == $project->manager_id
        ) {
            //validating data
            $validatedData = $request->validate($rules);
            //updating record
            Project::where('project_id', $project_id)->update($validatedData);
            return JSONHandler::emptySuccessfulJSONPackage();
        }
        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
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
