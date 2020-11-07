<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

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
}
