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

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'client_name',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'updated_at' => 'datetime',
    ];

    /**
     * retrieving all clients' information
     */
    public function readClientList()
    {
        //only admin can read client list

        $list = DB::table('clients')->select(
            'client_id',
            'client_name',
            'user_id'
        )
            ->whereNull("deleted_at")
            ->get()->toArray();

        for ($i = 0; $i < count($list); $i++) {
            $list[$i]->total_sale = $this->getTotalSale($list[$i]->client_id);
            $list[$i]->total_profit = $this->getTotalProfit($list[$i]->client_id);
        }

        return $list;
    }

    public function createClient($request)
    {
        //only admin can create new client
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == 'システム管理者') {
            $validatedData = $request->validated();

            //Creating record-- a client record can be created if any user exists as a point_of_contact_person
            if (User::where('user_id', '=', $request->input('user_id'))->first() != null) {
                Client::create($validatedData);
            }
        }
    }

    /**
     * retrieving single client's information
     */
    public function readClient($id)
    {
        //only admin and point of contact can read a single client's info
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

    public function updateClient($request, $id)
    {
        //validating data
        $validatedData = $request->validated();

        //updating record
        Client::where('client_id', $id)->update($validatedData);
    }

    public function deleteClient($id)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == 'システム管理者') {
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

    public function getTotalCost($id)
    {
        $projectObj = new Project();
        //getting all the projects id of a client
        $projects_id = DB::table('projects')->select('project_id')->where('client_id', $id)->get();

        $totalCost = 0;
        foreach ($projects_id as $project) {
            $project_id = $project->project_id;
            $totalCost += $projectObj->getProjectCost($project_id);
        }
        return $totalCost;
    }

    public function getTotalProfit($id)
    {
        $totalSale = $this->getTotalSale($id);
        $totalCost = $this->getTotalCost($id);
        $totalProfit = intval($totalSale) - intval($totalCost);

        return $totalProfit;
    }

    /**
     * Get all the projects for the client.
     */
    public function projects()
    {
        return $this->hasMany('App\Models\Project', 'client_id', 'client_id');
    }

    public function fetchClientLookup()
    {
        $list = DB::table('clients')->select(
            'client_id AS id',
            'client_name AS name',
        )
            ->whereNull("deleted_at")
            ->get()->toArray();
        return $list;
    }
}
