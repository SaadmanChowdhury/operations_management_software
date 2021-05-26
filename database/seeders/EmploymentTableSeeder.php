<?php

namespace Database\Seeders;

use App\Models\Employment;
use Illuminate\Database\Seeder;

class EmploymentTableSeeder extends Seeder
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
                'resignation_flag' => false,
            ],
            [
                'user_id' => 2, //konaka san
                'start_date' => '2019-01-01',
                'end_date' => null,
                'resignation_flag' => false,
            ],
            [
                'user_id' => 3, //maruta san
                'start_date' => '2019-04-01',
                'end_date' => null,
                'resignation_flag' => false,
            ],
            [
                'user_id' => 4, //tominaga san
                'start_date' => '2019-04-01',
                'end_date' => null,
                'resignation_flag' => false,
            ],
            [
                'user_id' => 5, //kanai san
                'start_date' => '2019-04-01',
                'end_date' => null,
                'resignation_flag' => false,
            ],
            [
                'user_id' => 6, //daiki san
                'start_date' => '2019-04-01',
                'end_date' => null,
                'resignation_flag' => false,
            ],
            [
                'user_id' => 7, //saadman san
                'start_date' => '2020-01-01',
                'end_date' => null,
                'resignation_flag' => false,
            ],
            [
                'user_id' => 8, //sumaiya san
                'start_date' => '2020-01-01',
                'end_date' => null,
                'resignation_flag' => false,
            ],
            [
                'user_id' => 9, //kaku san
                'start_date' => '2020-01-01',
                'end_date' => null,
                'resignation_flag' => false,
            ],
            [
                'user_id' => 10, //kameshima san
                'start_date' => '2020-01-01',
                'end_date' => null,
                'resignation_flag' => false,
            ],
            [
                'user_id' => 11, //tamura san
                'start_date' => '2020-01-01',
                'end_date' => null,
                'resignation_flag' => false,
            ],
            [
                'user_id' => 12, //matsumoto san
                'start_date' => '2020-01-01',
                'end_date' => null,
                'resignation_flag' => false,
            ],
            [
                'user_id' => 13, //samiul san
                'start_date' => '2021-04-01',
                'end_date' => null,
                'resignation_flag' => false,
            ],
            [
                'user_id' => 14, //sofia san
                'start_date' => '2021-04-01',
                'end_date' => null,
                'resignation_flag' => false,
            ],
            [
                'user_id' => 15, //roy san
                'start_date' => '2021-04-01',
                'end_date' => null,
                'resignation_flag' => false,
            ],
            [
                'user_id' => 16, //alif san
                'start_date' => '2021-04-01',
                'end_date' => '2021-06-30',
                'resignation_flag' => false,
            ],
            [
                'user_id' => 17, //israt san
                'start_date' => '2021-04-01',
                'end_date' => '2021-06-30',
                'resignation_flag' => false,
            ],
        ];

        Employment::insert($data);
    }
}
