<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory, Notifiable, SoftDeletes, Authenticatable;
    protected $primaryKey = 'customer_id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'customer_name',
        'point_of_contact_person_id',
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'updated_at' => 'datetime',
    ];


    public function createClient($request)
    {
         //only admin can create new client
         $loggedUser = auth()->user();
         if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $validatedData = $request->validate([
                'customer_name' => 'required',
                'point_of_contact_person_id' => 'required',
            ]);
            //saving new record
            Client::create($validatedData);
         }
    }


    /**
     * retrieving all clients' information
     */
    public function readClientList()
    {
        //only admin can read client list
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $list = DB::table('clients')->select(
                'customer_id',
                'customer_name',
                'point_of_contact_person_id'
            )
                ->whereNull("deleted_at")
                ->get()->toArray();
            return $list;
        }
    }


    /**
     * retrieving single client's information
     */
    public function readClient($id)
    {   
        //only admin can read a single client's info
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $client = Client::select([
                'customer_id',
                'customer_name',
                'point_of_contact_person_id'
            ])
                ->where('customer_id', $id)
                ->whereNull("deleted_at")
                ->first();
            return $client;
        }
    }


    public function updateClient($request, $id)
    {
        //validation rules
        $rules = [
            'customer_name' => 'required',
            'point_of_contact_person_id' => 'required',
        ];

        //only admin can change customer's info
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $rules['customer_name'] = 'required';
            $rules['point_of_contact_person_id'] = 'required';
        }

        //getting client details -- I didn't understand what I did here, but seems necessary -- kakunin shita houga ii desu -- 'client's name is not unique in migration'
        $client = Client::find($id);
        if ($client->customer_name == $request->customer_name) {
            $rules['customer_name'] = '';
        }

        //validating data
        $validatedData = $request->validate($rules);

        //updating record
        Client::where('customer_id', $id)->update($validatedData);
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

}
