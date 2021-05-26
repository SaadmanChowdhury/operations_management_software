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
                'name' => '中村',
                'email' => 'nakamura@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => '東京', //tokyo
                'tel' => '0123645789',
                'position' => 'PM', //PM
                // 'admission_day' => '2019-01-01',
                // 'exit_day' => null,
                // 'unit_price' => 400000,
                'user_authority' => 'システム管理者',

                'user_code' => '中村',
                'employment_classification' => 'full time',
                'affiliation_id' => null,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => '小中',
                'email' => 'konaka@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => '宮崎', //miyazaki
                'tel' => '0123456789',
                'position' => 'PL', //PL
                // 'admission_day' => '2019-01-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 350000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => '小中',
                'employment_classification' => 'full time',
                'affiliation_id' => null,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => '丸田',
                'email' => 'maruta@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => '宮崎', //miyazaki
                'tel' => '0123456789',
                'position' => 'SE', //SE
                // 'admission_day' => '2019-04-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 300000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => '丸田',
                'employment_classification' => 'full time',
                'affiliation_id' => null,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => '富永',
                'email' => 'tominaga@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => '宮崎', //miyazaki
                'tel' => '0123456789',
                'position' => 'SE', //SE
                // 'admission_day' => '2019-04-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 280000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => '富永',
                'employment_classification' => 'full time',
                'affiliation_id' => null,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => '金井',
                'email' => 'Kanai@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => '宮崎', //miyazaki
                'tel' => '0123456789',
                'position' => 'PG', //PG
                // 'admission_day' => '2019-04-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 240000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => '金井',
                'employment_classification' => 'full time',
                'affiliation_id' => null,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => '大起',
                'email' => 'daiki@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => '宮崎', //miyazaki
                'tel' => '0123456789',
                'position' => 'PG', //PG
                // 'admission_day' => '2019-04-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 240000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => '大起',
                'employment_classification' => 'full time',
                'affiliation_id' => null,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => 'サードマン',
                'email' => 'saadman@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => '宮崎', //miyazaki
                'tel' => '0123456789',
                'position' => 'PG', //PG
                // 'admission_day' => '2020-01-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 220000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => 'サードマン',
                'employment_classification' => 'full time',
                'affiliation_id' => null,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => 'スマイヤ',
                'email' => 'sumaya@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 1, //female
                'location' => '宮崎', //miyazaki
                'tel' => '0123456789',
                'position' => 'PG', //PG
                // 'admission_day' => '2020-01-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 220000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => 'スマイヤ',
                'employment_classification' => 'full time',
                'affiliation_id' => null,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => '賀来',
                'email' => 'kaku@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => '東京', //tokyo
                'tel' => '0123456789',
                'position' => 'PG', //PG
                // 'admission_day' => '2020-01-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 220000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => '賀来',
                'employment_classification' => 'full time',
                'affiliation_id' => null,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => '亀嶋',
                'email' => 'kameshima@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => '東京', //tokyo
                'tel' => '0123456789',
                'position' => 'PG', //PG
                // 'admission_day' => '2020-04-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 220000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => '亀嶋',
                'employment_classification' => 'full time',
                'affiliation_id' => null,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => '田村',
                'email' => 'tamura@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 1, //female
                'location' => '東京', //tokyo
                'tel' => '0123456789',
                'position' => 'PG', //PG
                // 'admission_day' => '2020-04-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 220000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => '田村',
                'employment_classification' => 'full time',
                'affiliation_id' => null,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => '松本',
                'email' => 'matsumoto@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => '東京', //tokyo
                'tel' => '0123456789',
                'position' => 'PG', //PG
                // 'admission_day' => '2020-04-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 220000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => '松本',
                'employment_classification' => 'full time',
                'affiliation_id' => null,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => 'サミウール',
                'email' => 'samiul@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => '宮崎', //miyazaki
                'tel' => '0123456789',
                'position' => 'PG', //PG
                // 'admission_day' => '2020-04-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 220000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => 'サミウール',
                'employment_classification' => 'full time',
                'affiliation_id' => null,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => 'ソフィア',
                'email' => 'sofia@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 1, //female
                'location' => '宮崎', //miyazaki
                'tel' => '0123456789',
                'position' => 'PG', //PG
                // 'admission_day' => '2020-04-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 220000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => 'ソフィア',
                'employment_classification' => 'full time',
                'affiliation_id' => null,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => 'ロイ',
                'email' => 'utshab@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => '宮崎', //miyazaki
                'tel' => '0123456789',
                'position' => 'PG', //PG
                // 'admission_day' => '2020-04-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 220000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => 'ロイ',
                'employment_classification' => 'full time',
                'affiliation_id' => null,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => 'アリフ',
                'email' => 'alif@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => '東京', //tokyo
                'tel' => '0123456789',
                'position' => 'PG', //PG
                // 'admission_day' => '2020-04-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 220000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => 'アリフ',
                'employment_classification' => 'SES',
                'affiliation_id' => 7,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
            [
                'name' => 'イスラト',
                'email' => 'israt@gtmi.co.jp',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'gender' => 0, //male
                'location' => '東京', //Tokyo
                'tel' => '0123456789',
                'position' => 'PG', //PG
                // 'admission_day' => '2020-04-01',
                // 'exit_day' => '2021-06-30',
                // 'unit_price' => 220000,
                'user_authority' => '一般ユーザー',
                // 'resign_day' => null,

                'user_code' => 'イスラト',
                'employment_classification' => 'SES',
                'affiliation_id' => 7,
                'commercial_distribution' => null,
                'emergency_contact' => null,
                'condition1' => null,
                'condition2' => null,
                'locker' => null,
                'remark' => null,
            ],
        ];

        User::insert($data);
    }
}
