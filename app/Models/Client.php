<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;

    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'customer_name',
        'user_id',
    ];

    public function createClient($request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required',
            'user_id' => 'required',
        ]);

        //saving new record
        Client::create($validatedData);
    }

    public function getTotalSale($id)
    {
        $totalSale = DB::table('clients')
            ->join('projects', 'clients.customer_id', '=', 'projects.customer_id')
            ->where('clients.customer_id', $id)
            ->sum('projects.sales_total');

        return $totalSale;
    }

    public function getTotalProfit($id)
    {
        $totalSale = $this->getTotalSale($id);
        $totalProfit = $totalSale / 3;

        return $totalProfit;
    }

    /**
     * Get all the projects for the client.
     */
    public function projects()
    {
        return $this->hasMany('App\Models\Project', 'customer_id', 'customer_id');
    }
}
