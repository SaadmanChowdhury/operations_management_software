<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActiveStatusUpsert;
use Illuminate\Support\Facades\Auth;
use App\Http\Utilities\JSONHandler;
use App\Services\ActiveStatusService;
use Illuminate\Support\Facades\DB;

class ActiveStatusController extends Controller
{

    protected $activeStatusService;

    public function __construct(ActiveStatusService $activeStatusService)
    {
        $this->activeStatusService = $activeStatusService;
    }


    public function updateActiveStatus(ActiveStatusUpsert $request)
    {
        if (!Auth::check())
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");

        $loggedUser = auth()->user();
        $user_authority = $loggedUser->user_authority; // logged in user authority
        if (!($user_authority == 'システム管理者' || $user_authority == '一般管理者'))
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");

        $this->activeStatusService->updateActiveStatus($request);

        return JSONHandler::emptySuccessfulJSONPackage();
    }
}
