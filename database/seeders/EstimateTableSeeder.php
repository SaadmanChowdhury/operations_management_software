<?php

namespace Database\Seeders;

use App\Models\Estimate;
use Illuminate\Database\Seeder;

class EstimateTableSeeder extends Seeder
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
                'project_id' => 1,
                'estimate_code' => 'es1forProject1',
                'estimate_status' => '調整中',
                'estimate_cost' => 110,
            ],
            [
                'project_id' => 1,
                'estimate_code' => 'es2forProject1',
                'estimate_status' => '調整中',
                'estimate_cost' => 120,
            ],
            [
                'project_id' => 2,
                'estimate_code' => 'es1forProject2',
                'estimate_status' => '調整中',
                'estimate_cost' => 300,
            ],
            [
                'project_id' => 3,
                'estimate_code' => 'es1forProject3',
                'estimate_status' => '調整中',
                'estimate_cost' => 250,
            ],
            [
                'project_id' => 3,
                'estimate_code' => 'es2forProject3',
                'estimate_status' => '調整中',
                'estimate_cost' => 260,
            ],

        ];

        Estimate::insert($data);
    }
}
