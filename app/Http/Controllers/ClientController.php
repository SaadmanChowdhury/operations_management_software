<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Utilities\JSONHandler;
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

        return view('client_list', $viewParams);
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            return view('client.create');
        } else {
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
        }
    }


    public function createClient(ClientRequest $request)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $client = new Client();
            $client->createClient($request);
            // return 'Client is successfully created.';
            return JSONHandler::emptySuccessfulJSONPackage();
        }
        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
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

    public function readClient($id)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $client = new Client();
            $info = $client->readClient($id);
            return JSONHandler::packagedJSONData($info);
        } else {
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
        }
    }


    public function getEditView($id)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $client = Client::find($id);
            return view('client.edit', compact('client'));
        } else {
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
        }
    }


    public function updateClient(Request $request)
    {
        $id = $request->id;
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $client = new Client();
            $client->updateClient($request, $id);
            return JSONHandler::emptySuccessfulJSONPackage();
        } else {
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
        }
    }


    public function deleteClient($id)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $client = new Client();
            $client->deleteClient($id);
            return JSONHandler::emptySuccessfulJSONPackage();
        } else {
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
        }
    }
}
