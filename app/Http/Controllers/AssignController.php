<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Assign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Utilities\JSONHandler;
use App\Services\AssignService;

class AssignController extends Controller
{

    protected $assignService;

    public function __construct(AssignService $assignService)
    {
        $this->assignService = $assignService;
    }

    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // $viewParams["list"] = $list;
        $viewParams["initialPreference"] = (new User())->getUIPreference(auth()->user()->user_id, "assign_summary_preference");

        return view('assign_summary', $viewParams);
    }

    public function assignSummary(Request $request)
    {
        if (!Auth::check())
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");

        $year = $request->year;
        $data = $this->assignService->assignSummary($year);

        /** Otherwise package the data into JSON-data and return */
        return JSONHandler::packagedJSONData($data);
    }
}
