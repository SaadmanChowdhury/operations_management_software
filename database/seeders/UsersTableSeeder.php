<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        $data = [
            [
                'name' => 'Nakmura',
                'email' => 'nakamura@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => 1, //tokyo
                'tel' => '0123645789',
                'position' => 0, //PM
                'admission_day' => '2019-01-01',
                'exit_day' => '',
                'unit_price' => 400000,
                'user_authority' => 0,
                'resign_day' => '',
            ],
            [
                'name' => 'Konaka',
                'email' => 'konaka@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => 0, //miyazaki
                'tel' => '0123456789',
                'position' => 1, //PL
                'admission_day' => '2019-01-01',
                'exit_day' => '',
                'unit_price' => 350000,
                'user_authority' => 2,
                'resign_day' => '',
            ],
            [
                'name' => 'Maruta',
                'email' => 'maruta@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => 0, //miyazaki
                'tel' => '0123456789',
                'position' => 2, //SE
                'admission_day' => '2019-04-01',
                'exit_day' => '',
                'unit_price' => 300000,
                'user_authority' => 2,
                'resign_day' => '',
            ],
            [
                'name' => 'Tominaga',
                'email' => 'tominaga@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => 0, //miyazaki
                'tel' => '0123456789',
                'position' => 2, //SE
                'admission_day' => '2019-04-01',
                'exit_day' => '',
                'unit_price' => 280000,
                'user_authority' => 2,
                'resign_day' => '',
            ],
            [
                'name' => 'Kanai',
                'email' => 'Kanai@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => 0, //miyazaki
                'tel' => '0123456789',
                'position' => 3, //PG
                'admission_day' => '2019-04-01',
                'exit_day' => '',
                'unit_price' => 240000,
                'user_authority' => 2,
                'resign_day' => '',
            ],
            [
                'name' => 'Daiki',
                'email' => 'daiki@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => 0, //miyazaki
                'tel' => '0123456789',
                'position' => 3, //PG
                'admission_day' => '2019-04-01',
                'exit_day' => '',
                'unit_price' => 240000,
                'user_authority' => 2,
                'resign_day' => '',
            ],
            [
                'name' => 'Saadman',
                'email' => 'saadman@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => 0, //miyazaki
                'tel' => '0123456789',
                'position' => 3, //PG
                'admission_day' => '2020-01-01',
                'exit_day' => '',
                'unit_price' => 220000,
                'user_authority' => 2,
                'resign_day' => '',
            ],
            [
                'name' => 'Sumaya',
                'email' => 'sumaya@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 1, //female
                'location' => 0, //miyazaki
                'tel' => '0123456789',
                'position' => 3, //PG
                'admission_day' => '2020-01-01',
                'exit_day' => '',
                'unit_price' => 220000,
                'user_authority' => 2,
                'resign_day' => '',
            ],
            [
                'name' => 'Kaku',
                'email' => 'kaku@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => 1, //tokyo
                'tel' => '0123456789',
                'position' => 3, //PG
                'admission_day' => '2020-01-01',
                'exit_day' => '',
                'unit_price' => 220000,
                'user_authority' => 2,
                'resign_day' => '',
            ],
            [
                'name' => 'Kameshima',
                'email' => 'kameshima@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => 1, //tokyo
                'tel' => '0123456789',
                'position' => 3, //PG
                'admission_day' => '2020-04-01',
                'exit_day' => '',
                'unit_price' => 220000,
                'user_authority' => 2,
                'resign_day' => '',
            ],
            [
                'name' => 'Tamura',
                'email' => 'tamura@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => 1, //tokyo
                'tel' => '0123456789',
                'position' => 3, //PG
                'admission_day' => '2020-04-01',
                'exit_day' => '',
                'unit_price' => 220000,
                'user_authority' => 2,
                'resign_day' => '',
            ],
            [
                'name' => 'Matsumoto',
                'email' => 'matsumoto@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => 1, //tokyo
                'tel' => '0123456789',
                'position' => 3, //PG
                'admission_day' => '2020-04-01',
                'exit_day' => '',
                'unit_price' => 220000,
                'user_authority' => 2,
                'resign_day' => '',
            ],
            [
                'name' => 'Samiul',
                'email' => 'samiul@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => 0, //miyazaki
                'tel' => '0123456789',
                'position' => 3, //PG
                'admission_day' => '2020-04-01',
                'exit_day' => '',
                'unit_price' => 220000,
                'user_authority' => 2,
                'resign_day' => '',
            ],
            [
                'name' => 'Sofia',
                'email' => 'sofia@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 1, //female
                'location' => 0, //miyazaki
                'tel' => '0123456789',
                'position' => 3, //PG
                'admission_day' => '2020-04-01',
                'exit_day' => '',
                'unit_price' => 220000,
                'user_authority' => 2,
                'resign_day' => '',
            ],
            [
                'name' => 'Utshab',
                'email' => 'utshab@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => 0, //miyazaki
                'tel' => '0123456789',
                'position' => 3, //PG
                'admission_day' => '2020-04-01',
                'exit_day' => '',
                'unit_price' => 220000,
                'user_authority' => 2,
                'resign_day' => '',
            ],
        ];

        User::insert($data);
    }
}
