<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;


class Client extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'client_id';

    protected $fillable = [
        'client_name',
        'user_id',
    ];

    protected $casts = [
        'updated_at' => 'datetime',
    ];

    /**
     * retrieving all clients' information*/
    public function readClientList()
    {
        //only admin can read client list
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $list = DB::table('clients')->select(
                'client_id',
                'client_name',
                'user_id'
            )
                ->whereNull("deleted_at")
                ->get()->toArray();
            return $list;
        }
    }

    public function createClient($request)
    {
        $validatedData = $request->validate([
            'client_name' => 'required',
            'user_id' => 'required',
        ]);

        //Creating record-- a client record can be created if any user exists as a point_of_contact_person
        if (User::where('user_id', '=', $request->input('user_id'))->first() != null) {
            Client::create($validatedData);
        }
    }

    public function readClient($id)
    {   
        //only admin can read a single client's info
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $client = Client::select([
                'client_id',
                'client_name',
                'user_id'
            ])
                ->where('client_id', $id)
                ->whereNull("deleted_at")
                ->first();
            return $client;
        }
    }

    public function updateClient($request, $id)
    {
        //validation rules
        $rules = [
            'client_name' => 'required',
            'user_id' => 'required',
        ];

        //only admin can change customer's info
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $rules['client_name'] = 'required';
            $rules['user_id'] = 'required';
        }

        //getting client details -- I didn't understand what I did here, but seems necessary -- kakunin shita houga ii desu -- 'client's name is not unique in migration'
        $client = Client::find($id);
        if ($client->client_name == $request->client_name) {
            $rules['client_name'] = '';
        }

        //validating data
        $validatedData = $request->validate($rules);

        //updating record-- a client record can be updated if any user exists as a point_of_contact_person
        if (User::where('user_id', '=', $request->input('user_id'))->first() != null) {
            Client::where('client_id', $id)->update($validatedData);
        }
    }

    public function deleteClient($id)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $client = Client::find($id);
            //soft delete
            $client->delete();
        }
    }



    public function getTotalSale($id)
    {
        $totalSale = DB::table('clients')
            ->join('projects', 'clients.client_id', '=', 'projects.client_id')
            ->where('clients.client_id', $id)
            ->sum('projects.sales_total');

        return $totalSale;
    }

    public function getTotalProfit($id)
    {
        $totalSale = $this->getTotalSale($id);
        $totalProfit = $totalSale / 3;

        return $totalProfit;
    }
}
