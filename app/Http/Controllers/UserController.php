<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function index()
    {
        /**
         * checking the user is logged in or not
         */
        if (!Auth::check()) {
            // return redirect('/login');
        }

        $user = new User();
        $list = $user->readUserList();
        $viewParams["list"] = $list;
        // \Illuminate\Support\Facades\Log::debug($list);
        return view('user_list', $viewParams);
    }

    public function readUser($id)
    {
        $loggedUser = auth()->user();

        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $user = new User();
            $info = $user->readUser($id);
            return $info;
        } else {
            if ($loggedUser->user_id == $id) {
                $user = new User();
                $info = $user->readUser($id);
                return $info;
            } else {
                return;
            }
        }
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $user = new User();
            $user->createUser($request);
            return 'User is successfully created.';
        }
        return;
    }
}
