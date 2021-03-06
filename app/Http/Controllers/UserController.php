<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpsert;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Utilities\JSONHandler;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = new User();
        $list = $user->static_readUserList();
        $loggedUser = auth()->user();
        $initialPreference = $user->getUIPreference($loggedUser->user_id, "user_list_preference");

        return view('user_list', ['users' => $list, 'loggedUser' => $loggedUser, 'initialPreference' => $initialPreference]);
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

    public function createUser(UserUpsert $request)
    {
        $loggedUser = auth()->user();

        if ($loggedUser->user_authority == 'システム管理者') {
            $user = new User();
            $user->createUser($request);
            return JSONHandler::emptySuccessfulJSONPackage();
        }

        return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
    }

    public function fetchUserList()
    {
        if (!Auth::check())
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");

        $data = $this->userService->fetchUserList();

        if (gettype($data) == "string") {
            return JSONHandler::errorJSONPackage($data);
        }

        return JSONHandler::packagedJSONData($data);
    }

    public function readUser(Request $request)
    {
        $loggedUser = auth()->user();
        $id = $request->userID;

        if ($loggedUser->user_authority == 'システム管理者' || $loggedUser->user_id == $id) {
            $user = new User();
            $info = $user->readUser($id);
            return JSONHandler::packagedJSONData($info);
        } else {
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
        }
    }


    public function updateUser(UserUpsert $request)
    {
        $id = $request->id;
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == 'システム管理者' || $loggedUser->user_id == $id) {
            $user = new User();
            $user->updateUser($request, $id);
            return JSONHandler::emptySuccessfulJSONPackage();
        } else {
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
        }
    }

    public function deleteUser(Request $request)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == 'システム管理者') {

            $user = new User();
            $user->deleteUser($request->id);
            return JSONHandler::emptySuccessfulJSONPackage();
        } else {

            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");
        }
    }

    public function updateUserUIPreference(Request $request)
    {
        $value = $request->value;
        if ($value > 3 || $value < 0)
            $value = 0;

        $loggedUser = auth()->user();
        $user = new User();
        $user->updateUserUIPreference($loggedUser->user_id, $request->pageName, $value);

        return JSONHandler::emptySuccessfulJSONPackage();
    }

    public function fetchUserLookup(Request $request)
    {
        $user = new User();
        return $user->fetchUserLookup();
    }
}
