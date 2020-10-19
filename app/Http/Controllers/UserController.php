<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        /**
         * checking the user is logged in or not
         */
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = new User();
        $list = $user->readUserList();
        return $list;
    }

    public function show($id)
    {
        $loggedUser = auth()->user();

        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $user = new User();
            $info = $user->adminReadUser($id);
            return $info;
        } else {
            if ($loggedUser->user_id == $id) {
                $user = new User();
                $info = $user->loggedInReadUser($id);
                return $info;
            } else {
                return;
            }
        }
    }
}
