<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Utilities\JSONHandler;

class UserController extends Controller
{

    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = new User();
        $list = $user->readUserList();
        $viewParams["list"] = $list;
        return view('user_list', ['users' => $list, 'loggedUser' => $user]);
    }

    public function getCreateView()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            return view('user.create');
        } else {
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
        }
    }

    public function getEditView($id)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $loggedUser = auth()->user();
        $user = User::find($id);
        return view('user.edit', compact('user', 'loggedUser'));
    }

    public function createUser(Request $request)
    {
        $loggedUser = auth()->user();

        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {
            $user = new User();
            $user->createUser($request);
            return JSONHandler::emptySuccessfulJSONPackage();
        }

        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
    }

    public function readUser(Request $request)
    {
        $loggedUser = auth()->user();
        $id = $request->userID;

        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {

            $user = new User();
            $info = $user->readUser($id);
            return JSONHandler::packagedJSONData($info);
        } else {

            if ($loggedUser->user_id == $id) {

                $user = new User();
                $info = $user->readUser($id);
                return JSONHandler::packagedJSONData($info);
            } else {
                return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
            }
        }
    }

    public function updateUser(Request $request)
    {

        \Illuminate\Support\Facades\Log::debug($request);

        $id = $request->id;
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {

            $user = new User();
            $user->updateUser($request, $id);
            return JSONHandler::emptySuccessfulJSONPackage();
        } else {

            if ($loggedUser->user_id == $id) {

                $user = new User();
                $user->updateUser($request, $id);
                return JSONHandler::emptySuccessfulJSONPackage();
            } else {
                return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
            }
        }
    }

    public function deleteUser(Request $request)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == config('User_authority.システム管理者')) {

            $user = new User();
            $user->deleteUser($request->id);
            return JSONHandler::emptySuccessfulJSONPackage();
        } else {

            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
        }
    }
}