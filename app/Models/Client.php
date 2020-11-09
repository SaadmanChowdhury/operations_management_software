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
        'point_of_contact_person_id',
    ];

    /**
     * retrieving all clients' information
     */
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
            'point_of_contact_person_id' => 'required',
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

    public function getTotalProfit($id)
    {
        $totalSale = $this->getTotalSale($id);
        $totalProfit = $totalSale / 3;

        return $totalProfit;
    }
}
