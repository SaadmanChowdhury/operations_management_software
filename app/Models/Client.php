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
        'point_of_contact_person_id',
    ];

    public function createClient($request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required',
            'point_of_contact_person_id' => 'required',
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
}
