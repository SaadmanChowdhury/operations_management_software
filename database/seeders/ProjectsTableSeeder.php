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
                'order_month' => "2020-09-01",
                'inspection_month' => "2021-08-01",
                'order_status' => '●',
                'business_situation' => '完了',
                'development_stage' => '開発完了',
            ],
            [
                'project_name' => '実績管理システム',
                'client_id' => 1, //client
                'manager_id' => 7,
                'sales_total' => 7500000,
                'budget' => 4462500,
                'order_month' => "2020-08-01",
                'inspection_month' => "2020-12-15",
                'order_status' => '●',
                'business_situation' => '完了',
                'development_stage' => '受注前着手',
            ],
            [
                'project_name' => 'ASE＿HP',
                'client_id' => 2, //client
                'manager_id' => 6,
                'sales_total' => 8750000,
                'budget' => 5206250,
                'order_month' => "2020-05-01",
                'inspection_month' => "2020-07-01",
                'order_status' => 'A',
                'business_situation' => '完了',
                'development_stage' => '設計',
            ],
            [
                'project_name' => 'PIVOT アンドロイドアプリ',
                'client_id' => 3, //client
                'manager_id' => 4,
                'sales_total' => 7350000,
                'budget' => 4373250,
                'order_month' => "2020-04-01",
                'inspection_month' => "2021-06-01",
                'order_status' => 'B',
                'business_situation' => '完了',
                'development_stage' => 'テスト',
            ],
            [
                'project_name' => 'Zoom プラグイン',
                'client_id' => 4, //client
                'manager_id' => 7,
                'sales_total' => 0,
                'budget' => 0,
                'order_month' => null,
                'inspection_month' => null,
                'order_status' => 'Z',
                'business_situation' => '見積済',
                'development_stage' => null,
            ],
            [
                'project_name' => 'CBC ムーバルタイプ',
                'client_id' => 5, //client
                'manager_id' => 6,
                'sales_total' => 4000000,
                'budget' => 1400000,
                'order_month' => "2021-01-01",
                'inspection_month' => "2021-03-31",
                'order_status' => 'A',
                'business_situation' => '検収中',
                'development_stage' => null,
            ],
            [
                'project_name' => 'ピープル LP',
                'client_id' => 6, //client
                'manager_id' => 6,
                'sales_total' => 200000,
                'budget' => 50000,
                'order_month' => "2020-12-15",
                'inspection_month' => "2021-01-15",
                'order_status' => 'A',
                'business_situation' => '完了',
                'development_stage' => '設計',
            ],
        ];

        Project::insert($data);
    }
}
