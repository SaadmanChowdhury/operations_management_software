<?php

namespace Database\Seeders;

use App\Models\Favorite;
use Illuminate\Database\Seeder;

class FavoriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            //favorite users
            [
                'user_id' => 1, //admin
                'item_type' => 'user',
                'item_id' => 7,
            ],
            [
                'user_id' => 1, //admin
                'item_type' => 'user',
                'item_id' => 10,
            ],
            [
                'user_id' => 1, //admin
                'item_type' => 'user',
                'item_id' => 12,
            ],
            [
                'user_id' => 3, //maruta san
                'item_type' => 'user',
                'item_id' => 6,
            ],
            [
                'user_id' => 3, //maruta san
                'item_type' => 'user',
                'item_id' => 8,
            ],
            [
                'user_id' => 3, //maruta san
                'item_type' => 'user',
                'item_id' => 10,
            ],
            [
                'user_id' => 3, //maruta san
                'item_type' => 'user',
                'item_id' => 14,
            ],
            [
                'user_id' => 3, //maruta san
                'item_type' => 'user',
                'item_id' => 6,
            ],
            [
                'user_id' => 6, //daiki san
                'item_type' => 'user',
                'item_id' => 7,
            ],
            [
                'user_id' => 6, //daiki san
                'item_type' => 'user',
                'item_id' => 8,
            ],
            [
                'user_id' => 6, //daiki san
                'item_type' => 'user',
                'item_id' => 9,
            ],
            [
                'user_id' => 6, //daiki san
                'item_type' => 'user',
                'item_id' => 11,
            ],
            [
                'user_id' => 7, //saadman san
                'item_type' => 'user',
                'item_id' => 8,
            ],
            [
                'user_id' => 7, //saadman san
                'item_type' => 'user',
                'item_id' => 9,
            ],
            [
                'user_id' => 7, //saadman san
                'item_type' => 'user',
                'item_id' => 10,
            ],
            [
                'user_id' => 7, //saadman san
                'item_type' => 'user',
                'item_id' => 13,
            ],
            [
                'user_id' => 7, //saadman san
                'item_type' => 'user',
                'item_id' => 14,
            ],
            // favorite projects
            [
                'user_id' => 3, //maruta san
                'item_type' => 'project',
                'item_id' => 1,
            ],
            [
                'user_id' => 3, //maruta san
                'item_type' => 'project',
                'item_id' => 2,
            ],
            [
                'user_id' => 6, //daiki san
                'item_type' => 'project',
                'item_id' => 3,
            ],
            [
                'user_id' => 6, //daiki san
                'item_type' => 'project',
                'item_id' => 4,
            ],
            [
                'user_id' => 7, //saadman san
                'item_type' => 'project',
                'item_id' => 1,
            ],
            [
                'user_id' => 7, //saadman san
                'item_type' => 'project',
                'item_id' => 2,
            ],
        ];

        Favorite::insert($data);
    }
}
