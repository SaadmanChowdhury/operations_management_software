<?php

namespace Database\Seeders;

use App\Models\Assign;
use Illuminate\Database\Seeder;

class AssignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assign::factory(10)->create();

        $data = [
            [
                'project_id' => 1,
                'user_id' => 3,
                'year' => 2020,
                'month' => 9,
                'execution' => 1,
            ],
            [
                'project_id' => 1,
                'user_id' => 3,
                'year' => 2020,
                'month' => 10,
                'execution' => 1,
            ],
            [
                'project_id' => 1,
                'user_id' => 3,
                'year' => 2020,
                'month' => 11,
                'execution' => 1,
            ],
            [
                'project_id' => 1,
                'user_id' => 3,
                'year' => 2020,
                'month' => 12,
                'execution' => 1,
            ],
            [
                'project_id' => 1,
                'user_id' => 6,
                'year' => 2020,
                'month' => 9,
                'execution' => .5,
            ],
            [
                'project_id' => 1,
                'user_id' => 6,
                'year' => 2020,
                'month' => 10,
                'execution' => .5,
            ],
            [
                'project_id' => 1,
                'user_id' => 6,
                'year' => 2020,
                'month' => 11,
                'execution' => .5,
            ],
            [
                'project_id' => 1,
                'user_id' => 6,
                'year' => 2020,
                'month' => 12,
                'execution' => .5,
            ],
            [
                'project_id' => 1,
                'user_id' => 7,
                'year' => 2020,
                'month' => 9,
                'execution' => .33,
            ],
            // [
            //     'project_id' => 2,
            //     'user_id' => 7,
            //     'year' => 2020,
            //     'month' => 3,
            // ],
            // [
            //     'project_id' => 2,
            //     'user_id' => 13,
            //     'year' => 2020,
            //     'month' => 3,
            // ],
            // [
            //     'project_id' => 2,
            //     'user_id' => 14,
            //     'year' => 2020,
            //     'month' => 3,
            // ],
            // [
            //     'project_id' => 2,
            //     'user_id' => 15,
            //     'year' => 2020,
            //     'month' => 3,
            // ],
            // [
            //     'project_id' => 3,
            //     'user_id' => 6,
            //     'year' => 2020,
            //     'month' => 3,
            // ],
            // [
            //     'project_id' => 3,
            //     'user_id' => 8,
            //     'year' => 2020,
            //     'month' => 3,
            // ],
            // [
            //     'project_id' => 3,
            //     'user_id' => 11,
            //     'year' => 2020,
            //     'month' => 3,
            // ],
            // [
            //     'project_id' => 4,
            //     'user_id' => 4,
            //     'year' => 2020,
            //     'month' => 4,
            // ],
            // [
            //     'project_id' => 4,
            //     'user_id' => 8,
            //     'year' => 2020,
            //     'month' => 4,
            // ],
        ];

        Assign::insert($data);
    }
}
