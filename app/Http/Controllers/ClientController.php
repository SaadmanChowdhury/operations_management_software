<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Utilities\JSONHandler;
use Illuminate\Support\Facades\Log;


class ClientController extends Controller
{
    //getting all clients' list
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $client = new Client();
        $list = $client->readClientList();
        $viewParams["list"] = $list;
        $viewParams["loggedInAuthority"] = auth()->user()->user_authority;
        return view('client_list', $viewParams);
    }

    //getting client's register form
    public function getCreateView()
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            return view('client.create');
        } else {
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
        }
    }

    //getting client's edit form
    public function getEditView($id)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $client = Client::find($id);
            Log::debug($id);
            return view('client.edit', compact('client', 'loggedUser'));
        } else {
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
        }
    }

    // create a client
    public function createClient(Request $request)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $client = new Client();
            $client->createClient($request);
            return JSONHandler::emptySuccessfulJSONPackage();
            
        }
        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
    }

    // update a client
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

    // read a single client's info
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

    // delete a single client
    public function deleteClient(Request $request)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $client = new Client();
            $client->deleteClient($request->id);
            return JSONHandler::emptySuccessfulJSONPackage();
        } else {
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
        }
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
}