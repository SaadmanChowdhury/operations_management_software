<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserOneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data = [
            [
                'name' => '中村',
                'email' => 'nakamura@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => '東京', //tokyo
                'tel' => '0123645789',
                'position' => 'PM', //PM
                'admission_day' => '2019-01-01',
                'exit_day' => null,
                'unit_price' => 400000,
                'user_authority' => 'システム管理者',
                'resign_day' => null,
            ],

        ];

        User::insert($data);
    }
}
