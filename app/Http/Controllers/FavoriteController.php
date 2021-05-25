<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActiveStatusUpsert;
use App\Http\Requests\FavoriteUpsert;
use Illuminate\Support\Facades\Auth;
use App\Http\Utilities\JSONHandler;
use App\Services\FavoriteService;

class FavoriteController extends Controller
{

    protected $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    public function updateFavoriteStatus(FavoriteUpsert $request)
    // public function updateFavoriteStatus()
    {
        if (!Auth::check())
            return JSONHandler::errorJSONPackage("UNAUTHORIZED_ACTION");

        $this->favoriteService->updateFavoriteStatus($request);
        return JSONHandler::emptySuccessfulJSONPackage();
    }
}
