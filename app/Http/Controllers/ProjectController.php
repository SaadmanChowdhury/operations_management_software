<?php

namespace App\Http\Controllers;

use App\Http\Utilities\JSONHandler;
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
        return view('project_list', ['projects' => $list]);
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
        $loggedUser = auth()->user();

        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $project = new Project();
            $project->createProject($request);
            return JSONHandler::emptySuccessfulJSONPackage();
        }
        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
    }

    public function readProject($id)
    {
        if (Auth::check()) {
            $project = new Project();
            $info = $project->readProject($id);
            return JSONHandler::packagedJSONData($info);
        }
        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
    }

    public function updateProject(Request $request)
    {

        $project_id = $request->project_id;
        $loggedUser = auth()->user();

        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $project = new Project();
            $project->updateProject($request, $project_id);
            return JSONHandler::emptySuccessfulJSONPackage();
        }
        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
    }

    public function deleteProject($id)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $project = new Project();
            $project->deleteProject($id);
            return JSONHandler::emptySuccessfulJSONPackage();
        } else {
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
        }
    }
}
