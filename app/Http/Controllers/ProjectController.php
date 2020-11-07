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
}
