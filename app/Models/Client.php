<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;

    protected $primaryKey = 'client_id';

    protected $fillable = [
        'client_name',
        'user_id',
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
        $validatedData = $request->validate([
            'client_name' => 'required',
            'user_id' => 'required',
        ]);

        //saving new record
        Client::create($validatedData);
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
}
