<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $project = new Project();
        $list = $project->readProjectList();
        return $list;
        $viewParams["list"] = $list;
        $initialPreference = (new User())->getUIPreference(auth()->user()->user_id, "project_list_preference");

        return view('project_list', ['projects' => $list, 'initialPreference' => $initialPreference]);
    }

    public function getCreateView()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return view('project.create');
    }

    public function getEditView($id)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $project = Project::find($id);
        return view('project.edit', compact('project'));
    }

    public function createProject(Request $request)
    {
        $project = new Project();
        $project->createProject($request);
    }

    public function readProject($id)
    {
        $project = new Project();
        $project->readProject($id);
    }

    public function updateProject(Request $request)
    {

        $project_id = $request->project_id;
        $project = new Project();
        $project->updateProject($request, $project_id);
    }

    public function deleteProject($id)
    {
        $project = new Project();
        $project->deleteProject($id);
    }
}