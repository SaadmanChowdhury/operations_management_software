<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Favorite extends Model
{
    use HasFactory;
    protected $primaryKey = 'favorite_id';
    protected $table = 'favorites';

    protected $guarded = [];

    public function addFavorite($user_id, $item_type, $item_id)
    {
        $favorite = DB::table('favorite')->insert([
            'user_id' => $user_id,
            'item_type' => $item_type,
            'item_id' => $item_id,
        ]);
        return $favorite;
    }

    public function removeFavorite($user_id, $item_type, $item_id)
    {
        $favorite = DB::table('favorite')
            ->where('user_id', $user_id)
            ->where('item_type', $item_type)
            ->where('item_id', $item_id)
            ->delete();
        return $favorite;
    }
}
