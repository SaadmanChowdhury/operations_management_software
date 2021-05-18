<?php

namespace Database\Seeders;

use App\Models\Salary;
use Illuminate\Database\Seeder;

class SalaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'user_id' => 1, //nakamura san
                'start_date' => '2019-01-01',
                'end_date' => null,
                'salary' => 400000,
            ],
            [
                'user_id' => 2, //konaka san
                'start_date' => '2019-01-01',
                'end_date' => null,
                'salary' => 300000,
            ],
            [
                'user_id' => 3, //maruta san
                'start_date' => '2019-04-01',
                'end_date' => null,
                'salary' => 280000,
            ],
            [
                'user_id' => 4, //tominaga san
                'start_date' => '2019-04-01',
                'end_date' => null,
                'salary' => 260000,
            ],
            [
                'user_id' => 5, //kanai san
                'start_date' => '2019-04-01',
                'end_date' => null,
                'salary' => 240000,
            ],
            [
                'user_id' => 6, //daiki san
                'start_date' => '2019-04-01',
                'end_date' => null,
                'salary' => 240000,
            ],
            [
                'user_id' => 7, //saadman san
                'start_date' => '2020-01-01',
                'end_date' => null,
                'salary' => 230000,
            ],
            [
                'user_id' => 8, //sumaiya san
                'start_date' => '2020-01-01',
                'end_date' => null,
                'salary' => 230000,
            ],
            [
                'user_id' => 1, //kaku san
                'start_date' => '2020-01-01',
                'end_date' => null,
                'salary' => 220000,
            ],
            [
                'user_id' => 1, //kameshima san
                'start_date' => '2020-01-01',
                'end_date' => null,
                'salary' => 220000,
            ],
            [
                'user_id' => 1, //tamura san
                'start_date' => '2020-01-01',
                'end_date' => null,
                'salary' => 220000,
            ],
            [
                'user_id' => 1, //matsumoto san
                'start_date' => '2020-01-01',
                'end_date' => null,
                'salary' => 220000,
            ],
            [
                'user_id' => 1, //samiul san
                'start_date' => '2021-04-01',
                'end_date' => null,
                'salary' => 220000,
            ],
            [
                'user_id' => 1, //sofia san
                'start_date' => '2021-04-01',
                'end_date' => null,
                'salary' => 400000,
            ],
            [
                'user_id' => 1, //roy san
                'start_date' => '2021-04-01',
                'end_date' => null,
                'salary' => 220000,
            ],
            [
                'user_id' => 1, //alif san
                'start_date' => '2021-04-01',
                'end_date' => '2021-06-30',
                'salary' => 214000,
            ],
            [
                'user_id' => 1, //israt san
                'start_date' => '2021-04-01',
                'end_date' => '2021-06-30',
                'salary' => 214000,
            ],
        ];

        Salary::insert($data);
    }
}
