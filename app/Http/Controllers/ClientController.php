<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

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
