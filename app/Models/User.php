<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

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
        'location',
        'admission_day',
        'exit_day',
        'unit_price',
        'user_authority',
        'resign_day'
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

    // protected $telFormat = 'Y-m-d';

    /**
     * retrieving all users information
     */
    public function readUserList()
    {
        $list = DB::table('users')->select(
            'user_id as userID',
            'name as username',
            'email as email',
            'gender as gender',
            'location as location',
            'tel as tel',
            'position as position',
            'admission_day as admissionDay',
            'exit_day as exitDay',
            'unit_price as unitPrice',
            'user_authority as authority',
            'resign_day as resignationDay'
        )
            ->whereNull("deleted_at")
            ->get()->toArray();
        return $list;
    }

    /**
     * retrieving all users information
     */
    public function static_readUserList()
    {
        $list = DB::table('users')->select(
            'user_id',
            'name',
            'email',
            'gender',
            'location',
            'tel',
            'position',
            'admission_day',
            'exit_day',
            'unit_price',
            'user_authority',
            'resign_day'
        )
            ->whereNull("deleted_at")
            ->get()->toArray();
        return $list;
    }

    /**
     * retrieving single user information
     */

    public function readUser($id)
    {
        $user = User::select([
            'user_id',
            'name',
            'email',
            'gender',
            'location',
            'tel',
            'position',
            'admission_day',
            'exit_day',
            'unit_price',
            'user_authority',
            'resign_day'
        ])->where('user_id', $id)
            ->whereNull("deleted_at")
            ->first();
        return $user;
    }

    public function createUser($request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = bcrypt($request->password);
        // $validatedData['position'] = $this->convertPositionToInt($request->position);
        // $validatedData['user_authority'] = $this->convertAuthToInt($request->user_authority);
        // $validatedData['location'] = $this->convertLocationToInt($request->location);

        //saving new record
        User::create($validatedData);
    }

    public function convertPositionToInt($sentPos)
    {
        $allPos = config('constants.Position');
        foreach ($allPos as $pos => $intPos) {
            if ($pos == $sentPos) {
                return $intPos;
            }
        }
    }

    public function convertAuthToInt($sentAuth)
    {
        $allAuth = config('constants.User_authority');
        foreach ($allAuth as $auth => $intAuth) {
            if ($auth == $sentAuth) {
                return $intAuth;
            }
        }
    }

    public function convertLocationToInt($sentLoc)
    {
        $allLoc = config('constants.Location');
        foreach ($allLoc as $Loc => $intLoc) {
            if ($Loc == $sentLoc) {
                return $intLoc;
            }
        }
    }



    public function updateUser($request, $id)
    {
        $loggedUser = auth()->user();
        //validating data
        $validatedData = $request->validated();

        //if the password has been changed -> hashing password
        if ($request->password != null) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            // the password is not changed, so setting the old password
            $data = User::select('password')->where('user_id', $id)->first();
            $oldPassword = $data->password;
            $validatedData['password'] = $oldPassword;
        }

        //if the logged in user is general user then he/she will not be able to change the unit_price
        if ($loggedUser->user_authority != 'システム管理者') {
            unset($validatedData['unit_price']);
        }

        //changing the array key name from id to user_id
        $validatedData['user_id'] = $validatedData['id'];
        unset($validatedData['id']);

        //updating record
        User::where('user_id', $id)->update($validatedData);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        //soft delete
        $user->delete();
    }

    /**
     * The projects that belong to the user.
     */
    public function projects()
    {
        return $this->belongsToMany('App\Models\Project', 'assign', 'user_id', 'project_id');
    }

    public function getUIPreference($id, $column)
    {
        return User::where('user_id', $id)->first()->$column;
    }

    public function updateUserUIPreference($id, $column, $value)
    {
        User::where('user_id', $id)->update(array($column => $value));
    }

    public function fetchUserLookup()
    {
        $list = DB::table('users')->select(
            'user_id AS id',
            'name AS name',
        )
            ->whereNull("deleted_at")
            ->get()->toArray();
        return $list;
    }

    public function changeActiveStatus($item_id, $active_status)
    {
        return DB::table('users')
            ->where('user_id', $item_id)
            ->update(['active_status' => $active_status]);
    }
}
