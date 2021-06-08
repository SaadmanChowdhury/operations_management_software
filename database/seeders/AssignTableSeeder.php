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
            /***************  PROJECT 1  ***************/
            [
                'project_id' => 1,
                'user_id' => 3,
                'year' => 2020,
                'month' => 11,
                'plan_man_month' => 1,
            ],
            [
                'project_id' => 1,
                'user_id' => 3,
                'year' => 2020,
                'month' => 12,
                'plan_man_month' => 1,
            ],
            [
                'project_id' => 1,
                'user_id' => 3,
                'year' => 2021,
                'month' => 01,
                'plan_man_month' => 1,
            ],
            [
                'project_id' => 1,
                'user_id' => 3,
                'year' => 2021,
                'month' => 02,
                'plan_man_month' => 1,
            ],
            [
                'project_id' => 1,
                'user_id' => 3,
                'year' => 2021,
                'month' => 03,
                'plan_man_month' => 1,
            ],
            [
                'project_id' => 1,
                'user_id' => 6,
                'year' => 2020,
                'month' => 11,
                'plan_man_month' => 1,
            ],
            [
                'project_id' => 1,
                'user_id' => 6,
                'year' => 2020,
                'month' => 12,
                'plan_man_month' => 1,
            ],
            [
                'project_id' => 1,
                'user_id' => 6,
                'year' => 2021,
                'month' => 01,
                'plan_man_month' => 0.5,
            ],
            [
                'project_id' => 1,
                'user_id' => 6,
                'year' => 2021,
                'month' => 02,
                'plan_man_month' => 0.5,
            ],
            [
                'project_id' => 1,
                'user_id' => 6,
                'year' => 2021,
                'month' => 03,
                'plan_man_month' => 0.5,
            ],
            [
                'project_id' => 1,
                'user_id' => 5,
                'year' => 2020,
                'month' => 11,
                'plan_man_month' => 1,
            ],
            [
                'project_id' => 1,
                'user_id' => 5,
                'year' => 2020,
                'month' => 12,
                'plan_man_month' => 1,
            ],
            [
                'project_id' => 1,
                'user_id' => 5,
                'year' => 2021,
                'month' => 01,
                'plan_man_month' => 1,
            ],
            [
                'project_id' => 1,
                'user_id' => 5,
                'year' => 2021,
                'month' => 02,
                'plan_man_month' => 1,
            ],
            [
                'project_id' => 1,
                'user_id' => 5,
                'year' => 2021,
                'month' => 03,
                'plan_man_month' => 1,
            ],


            
            /***************  PROJECT 2 - Jisseki  ***************/
            // USER 7
            ['project_id' => 2, 'user_id' => 7, 'year' => 2021, 'month' => 03, 'plan_man_month' => 0.5,],
            ['project_id' => 2, 'user_id' => 7, 'year' => 2021, 'month' => 04, 'plan_man_month' => 1,],
            ['project_id' => 2, 'user_id' => 7, 'year' => 2021, 'month' => 05, 'plan_man_month' => 1,],
            ['project_id' => 2, 'user_id' => 7, 'year' => 2021, 'month' => 06, 'plan_man_month' => 0.5,],
            ['project_id' => 2, 'user_id' => 7, 'year' => 2021, 'month' => 07, 'plan_man_month' => 0.5,],
            // USER 13
            ['project_id' => 2, 'user_id' => 13, 'year' => 2021, 'month' => 04, 'plan_man_month' => 1,],
            ['project_id' => 2, 'user_id' => 13, 'year' => 2021, 'month' => 05, 'plan_man_month' => 1,],
            ['project_id' => 2, 'user_id' => 13, 'year' => 2021, 'month' => 06, 'plan_man_month' => 1,],
            ['project_id' => 2, 'user_id' => 13, 'year' => 2021, 'month' => 07, 'plan_man_month' => 1,],
            // USER 14
            ['project_id' => 2, 'user_id' => 14, 'year' => 2021, 'month' => 04, 'plan_man_month' => 1,],
            ['project_id' => 2, 'user_id' => 14, 'year' => 2021, 'month' => 05, 'plan_man_month' => 1,],
            ['project_id' => 2, 'user_id' => 14, 'year' => 2021, 'month' => 06, 'plan_man_month' => 1,],
            ['project_id' => 2, 'user_id' => 14, 'year' => 2021, 'month' => 07, 'plan_man_month' => 1,],
            // USER 15
            ['project_id' => 2, 'user_id' => 15, 'year' => 2021, 'month' => 04, 'plan_man_month' => 1,],
            ['project_id' => 2, 'user_id' => 15, 'year' => 2021, 'month' => 05, 'plan_man_month' => 1,],
            ['project_id' => 2, 'user_id' => 15, 'year' => 2021, 'month' => 06, 'plan_man_month' => 1,],
            ['project_id' => 2, 'user_id' => 15, 'year' => 2021, 'month' => 07, 'plan_man_month' => 1,],



            /***************  PROJECT 3  - ASE ***************/
            // USER 6
            ['project_id' => 3,'user_id' => 6,'year' => 2021,'month' => 01,'plan_man_month' => 1,],
            ['project_id' => 3,'user_id' => 6,'year' => 2021,'month' => 02,'plan_man_month' => .5,],
            ['project_id' => 3,'user_id' => 6,'year' => 2021,'month' => 03,'plan_man_month' => .5,],
            // USER 9
            ['project_id' => 3,'user_id' => 9,'year' => 2021,'month' => 01,'plan_man_month' => 1,],
            ['project_id' => 3,'user_id' => 9,'year' => 2021,'month' => 02,'plan_man_month' => 1,],
            ['project_id' => 3,'user_id' => 9,'year' => 2021,'month' => 03,'plan_man_month' => 1,],
            // USER 10
            ['project_id' => 3,'user_id' => 10,'year' => 2021,'month' => 01,'plan_man_month' => 1,],
            ['project_id' => 3,'user_id' => 10,'year' => 2021,'month' => 02,'plan_man_month' => 1,],
            ['project_id' => 3,'user_id' => 10,'year' => 2021,'month' => 03,'plan_man_month' => 1,],
            // USER 11
            ['project_id' => 3,'user_id' => 11,'year' => 2021,'month' => 01,'plan_man_month' => 1,],
            ['project_id' => 3,'user_id' => 11,'year' => 2021,'month' => 02,'plan_man_month' => 1,],
            ['project_id' => 3,'user_id' => 11,'year' => 2021,'month' => 03,'plan_man_month' => 1,],
            // USER 12
            ['project_id' => 3,'user_id' => 12,'year' => 2021,'month' => 01,'plan_man_month' => 1,],
            ['project_id' => 3,'user_id' => 12,'year' => 2021,'month' => 02,'plan_man_month' => 1,],
            ['project_id' => 3,'user_id' => 12,'year' => 2021,'month' => 03,'plan_man_month' => 1,],


            /***************  PROJECT 4  - PIVOT Android ***************/

            // USER 4
            ['project_id' => 4,'user_id' => 4,'year' => 2021,'month' => 01,'plan_man_month' => 1,],
            ['project_id' => 4,'user_id' => 4,'year' => 2021,'month' => 02,'plan_man_month' => 0.5,],
            ['project_id' => 4,'user_id' => 4,'year' => 2021,'month' => 03,'plan_man_month' => 0.5,],

            // USER 8
            ['project_id' => 4,'user_id' => 8,'year' => 2021,'month' => 01,'plan_man_month' => 1,],
            ['project_id' => 4,'user_id' => 8,'year' => 2021,'month' => 02,'plan_man_month' => 1,],
            ['project_id' => 4,'user_id' => 8,'year' => 2021,'month' => 03,'plan_man_month' => 1,],
            ['project_id' => 4,'user_id' => 8,'year' => 2021,'month' => 04,'plan_man_month' => 1,],

            /***************  PROJECT 5  - PIVOT iOS ***************/
            // USER 4
            ['project_id' => 5,'user_id' => 4,'year' => 2021,'month' => 02,'plan_man_month' => 0.5,],
            ['project_id' => 5,'user_id' => 4,'year' => 2021,'month' => 03,'plan_man_month' => 0.5,],
            ['project_id' => 5,'user_id' => 4,'year' => 2021,'month' => 04,'plan_man_month' => 0.5,],
            ['project_id' => 5,'user_id' => 4,'year' => 2021,'month' => 05,'plan_man_month' => 0.5,],

            /***************  PROJECT 6  - PIVOT Fenrir ***************/
            // USER 4
            ['project_id' => 6,'user_id' => 4,'year' => 2021,'month' => 04,'plan_man_month' => 0.5,],
            ['project_id' => 6,'user_id' => 4,'year' => 2021,'month' => 05,'plan_man_month' => 0.5,],
            ['project_id' => 6,'user_id' => 4,'year' => 2021,'month' => 06,'plan_man_month' => 1,],
            ['project_id' => 6,'user_id' => 4,'year' => 2021,'month' => 07,'plan_man_month' => 1,],

            /***************  PROJECT 8  - CBC ***************/
            // USER 7
            ['project_id' => 8,'user_id' => 7,'year' => 2021,'month' => 01,'plan_man_month' => 1,],
            ['project_id' => 8,'user_id' => 7,'year' => 2021,'month' => 02,'plan_man_month' => 1,],
            ['project_id' => 8,'user_id' => 7,'year' => 2021,'month' => 03,'plan_man_month' => 1,],
            // USER 13
            ['project_id' => 8,'user_id' => 13,'year' => 2021,'month' => 01,'plan_man_month' => 1,],
            ['project_id' => 8,'user_id' => 13,'year' => 2021,'month' => 02,'plan_man_month' => 1,],
            ['project_id' => 8,'user_id' => 13,'year' => 2021,'month' => 03,'plan_man_month' => 1,],
            // USER 14
            ['project_id' => 8,'user_id' => 14,'year' => 2021,'month' => 01,'plan_man_month' => 1,],
            ['project_id' => 8,'user_id' => 14,'year' => 2021,'month' => 02,'plan_man_month' => 1,],
            ['project_id' => 8,'user_id' => 14,'year' => 2021,'month' => 03,'plan_man_month' => 1,],
            // USER 15
            ['project_id' => 8,'user_id' => 15,'year' => 2021,'month' => 01,'plan_man_month' => 1,],
            ['project_id' => 8,'user_id' => 15,'year' => 2021,'month' => 02,'plan_man_month' => 1,],
            ['project_id' => 8,'user_id' => 15,'year' => 2021,'month' => 03,'plan_man_month' => 1,],

            /***************  PROJECT 9  - Test ***************/
            // USER 1
            ['project_id' => 9,'user_id' => 1,'year' => 2020,'month' => 11,'plan_man_month' => 1,],
            ['project_id' => 9,'user_id' => 1,'year' => 2020,'month' => 12,'plan_man_month' => 1,],
            ['project_id' => 9,'user_id' => 1,'year' => 2021,'month' => 01,'plan_man_month' => 1,],
            ['project_id' => 9,'user_id' => 1,'year' => 2021,'month' => 02,'plan_man_month' => 1,],
            ['project_id' => 9,'user_id' => 1,'year' => 2021,'month' => 03,'plan_man_month' => 1,],
            // USER 2
            ['project_id' => 9,'user_id' => 2,'year' => 2020,'month' => 11,'plan_man_month' => 1,],
            ['project_id' => 9,'user_id' => 2,'year' => 2020,'month' => 12,'plan_man_month' => 1,],
            ['project_id' => 9,'user_id' => 2,'year' => 2021,'month' => 01,'plan_man_month' => 1,],
            ['project_id' => 9,'user_id' => 2,'year' => 2021,'month' => 02,'plan_man_month' => 1,],
            ['project_id' => 9,'user_id' => 2,'year' => 2021,'month' => 03,'plan_man_month' => 1,],


        ];

        Assign::insert($data);
    }
}
