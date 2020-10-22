<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company',
        'commercial_distribute',
        'tel',
        'position',
        'admission_day',
        'exit_day',
        'unit_price',
        'user_authority',
        'delete_day'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * retrieving all users information
     */
    public function readUserList()
    {
        $list = DB::table('users')->select(
            'name',
            'email',
            'company',
            'commercial_distribute',
            'tel',
            'position',
            'admission_day',
            'exit_day',
            'unit_price',
            'user_authority',
            'delete_day'
        )->get()->toArray();
        return $list;
    }

    /**
     * retrieving single user information
     */

    public function readUser($id)
    {
        $user = User::select([
            'name',
            'email',
            'company',
            'commercial_distribute',
            'tel',
            'position',
            'admission_day',
            'exit_day',
            'unit_price',
            'user_authority',
            'delete_day'
        ])->where('user_id', $id)->first();
        return $user;
    }

    public function createUser($request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'company' => '',
            'commercial_distribute' => '',
            'tel' => 'required',
            'position' => 'required',
            'admission_day' => 'required',
            'exit_day' => '',
            'unit_price' => 'required',
            'user_authority' => 'required',
            'delete_day' => '',
        ]);

        $validatedData['password'] = bcrypt($request->password);

        //saving new record
        User::create($validatedData);
    }

    public function updateUser($request, $id)
    {
        //validation rules
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'company' => '',
            'commercial_distribute' => '',
            'tel' => 'required',
            'position' => 'required',
            'admission_day' => 'required',
            'exit_day' => '',
            'unit_price' => 'required',
            'user_authority' => 'required',
            'delete_day' => '',
        ];

        //getting user details
        $user = User::find($id);
        if ($user->email == $request->email) {
            $rules['email'] = '';
        }

        //validating data
        $validatedData = $request->validate($rules);

        //hashing password
        $validatedData['password'] = bcrypt($request->password);

        //updating record
        User::where('user_id', $id)->update($validatedData);
    }
}
