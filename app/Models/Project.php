<?php

namespace App\Models;

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
    ];

    public function readProjectList()
    {
        $project = Project::select([
            'project_id',
            'project_name',
        ])->get();

        return $project;
    }

    public function createProject($request)
    {
        $validatedData = $request->validate([
            'project_name' => 'required',
            'customer_id' => 'required',
            'manager_id' => 'required',
        ]);

        //saving new record
        Project::create($validatedData);
    }

    public function readProject($id)
    {
        $project = Project::select([
            'project_id',
            'project_name',
            'customer_id',
            'manager_id',

        ])->where('project_id', $id)
            ->whereNull("deleted_at")
            ->first();
        return $project;
    }

    public function updateProject($request, $project_id)
    {
        //validation rules
        $rules = [
            'project_name' => 'required',
            'customer_id' => 'required',
            'manager_id' => 'required',
        ];

        //only admin can update the project
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            //validating data
            $validatedData = $request->validate($rules);
            //updating record
            Project::where('project_id', $project_id)->update($validatedData);
        }
    }

    public function deleteProject($id)
    {
        $project = Project::find($id);
        //soft delete
        $project->delete();
    }
}
