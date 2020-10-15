<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = new User();
        $list = $user->readUserList();
        return $list;
    }

    public function show($id)
    {
        $user = new User();
        $info = $user->readUser($id);
        return $info;
    }
}
