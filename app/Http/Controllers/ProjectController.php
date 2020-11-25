<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = new User();
        $project = new Project();
        $list = $project->readProjectList();

        $viewParams["list"] = $list;
        $viewParams["loggedInUser"] = auth()->user();
        $viewParams["loggedInAuthority"] = auth()->user()->user_authority;
        $viewParams["initialPreference"] = $user->getUIPreference($viewParams["loggedInUser"]->user_id, "project_list_preference");

        return view('project_list', $viewParams);
    }

    public function getCreateView()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $managers = User::select(['user_id', 'name'])->get();
        $customers = Client::select(['client_id', 'client_name'])->get();

        return view('project.create', compact('managers', 'customers'));
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

    public function getProjectProfit($project_id)
    {
        $project = new Project();
        return $project->getProjectProfit($project_id);
    }
}