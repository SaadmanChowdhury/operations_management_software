<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Project::factory(10)->create();

        $data = [
            [
                'project_name' => '勤怠管理システム',
                'client_id' => 1, //client
                'manager_id' => 3,
                'sales_total' => 12000000,
                'budget' => 7140000,
                // 'order_month' => 12,
                // 'inspection_month' => "",
                'order_status' => 4,
                'business_situation' => 5,
                'development_stage' => 4,
            ],
            [
                'project_name' => '実績管理システム',
                'client_id' => 1, //client
                'manager_id' => 7,
                'sales_total' => 7500000,
                'budget' => 4462500,
                'order_status' => 4,
                'business_situation' => 5,
                'development_stage' => 0,
            ],
            [
                'project_name' => 'ASE＿HP',
                'client_id' => 2, //client
                'manager_id' => 6,
                'sales_total' => 8750000,
                'budget' => 5206250,
                'order_status' => 0,
                'business_situation' => 5,
                'development_stage' => 2,
            ],
            [
                'project_name' => 'PIVOT アンドロイドアプリ',
                'client_id' => 3, //client
                'manager_id' => 4,
                'sales_total' => 7350000,
                'budget' => 4373250,
                'order_status' => 1,
                'business_situation' => 5,
                'development_stage' => 3,
            ],
            [
                'project_name' => 'Zoom プラグイン',
                'client_id' => 4, //client
                'manager_id' => 7,
                'sales_total' => 0,
                'budget' => 0,
                'order_status' => 3,
                'business_situation' => 2,
                'development_stage' => null,
            ],
            [
                'project_name' => 'CBC ムーバルタイプ',
                'client_id' => 5, //client
                'manager_id' => 6,
                'sales_total' => 4000000,
                'budget' => 1400000,
                'order_status' => 0,
                'business_situation' => 4,
                'development_stage' => null,
            ],
            [
                'project_name' => 'ピープル LP',
                'client_id' => 6, //client
                'manager_id' => 6,
                'sales_total' => 200000,
                'budget' => 50000,
                'order_status' => 0,
                'business_situation' => 5,
                'development_stage' => 2,
            ],
        ];

        Project::insert($data);
    }
}