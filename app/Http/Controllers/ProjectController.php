<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectUpsert;
use App\Services\ProjectService;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Utilities\JSONHandler;

class ProjectController extends Controller
{

    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

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

    public function fetchProjectList()
    {
        /** CHECK IF USER IS LOGGED IN */
        /** If not logged in return not authorized JSON alert */
        if (!Auth::check())
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");

        /** else, forward to Service */
        $data = $this->projectService->fetchProjectList();

        /** if the returned data is a string, then probably an error happened in the Service or Modal layer */
        /** in that case package the error into JSON-error and return */
        if (gettype($data) == "string") {
            return JSONHandler::errorJSONPackage($data);
        }

        /** Otherwise package the data into JSON-data and return */
        return JSONHandler::packagedJSONData($data);
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

    public function createProject(ProjectUpsert $request)
    {
        // $project = new Project();
        // $project->createProject($request);
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
        $project = new Project();
        $project->readProject($id);
    }

    public function updateProject(ProjectUpsert $request)
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
