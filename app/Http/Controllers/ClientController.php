<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{

    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $client = new Client();
        $list = $client->readClientList();

        $viewParams["list"] = $list;
        $viewParams["loggedInUser"] = auth()->user();
        $viewParams["loggedInAuthority"] = auth()->user()->user_authority;
        $viewParams["initialPreference"] = (new User())->getUIPreference(auth()->user()->user_id, "client_list_preference");

        \Illuminate\Support\Facades\Log::debug($viewParams["initialPreference"]);

        return view('client_list', $viewParams);
    }

    public function create()
    {
        return view('client.create');
    }

    public function store(Request $request)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $client = new Client();
            $client->createClient($request);
            return 'Client is successfully created.';
        }
        return;
    }

    //getting total sale from a client
    public function getTotalSale($id)
    {
        $client = new Client();
        return $client->getTotalSale($id);
    }

    //getting total profit from a client
    public function getTotalProfit($id)
    {
        $client = new Client();
        return $client->getTotalProfit($id);
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
}
