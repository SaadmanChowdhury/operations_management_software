<?php

namespace App\Models;

use App\Http\Utilities\JSONHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'project_id';

    protected $fillable = [
        'project_name',
        'customer_id',
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
        $project = Project::select([
            'project_id',
            'project_name',
            'customer_id',
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
                'customer_id' => 'required',
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
            'customer_id',
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
            'customer_id' => 'required',
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
     * The users that belong to the project.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'assign', 'project_id', 'user_id');
    }
}
