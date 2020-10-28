<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

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
}
