<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}