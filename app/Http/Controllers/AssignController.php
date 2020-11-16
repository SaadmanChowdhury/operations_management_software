<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Assign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // $viewParams["list"] = $list;
        $viewParams["initialPreference"] = (new User())->getUIPreference(auth()->user()->user_id, "assign_summary_preference");

        return view('assign_summary', $viewParams);
    }
}