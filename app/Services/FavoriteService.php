<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;

class FavoriteService
{

    protected $favoriteModel;

    public function __construct(Favorite $favoriteModel)
    {
        $this->$favoriteModel = $favoriteModel;
    }

    public function updateFavoriteStatus($request)
    {
        $favoriteModel = new Favorite;

        $user_id = $request->userID;
        $item_type = $request->itemType;
        $item_id = $request->itemID;
        $favorite_status = $request->favoriteStatus;

        if ($favorite_status) {
            return $favoriteModel->addFavorite($user_id, $item_type, $item_id);
        } else {
            return $favoriteModel->removeFavorite($user_id, $item_type, $item_id);
        }
    }
}
