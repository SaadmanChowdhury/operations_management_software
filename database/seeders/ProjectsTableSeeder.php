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
                'project_name' => 'Kintai',
                'client_id' => 1, //client
                'manager_id' => 3,
                'sales_total' => 12000000,
                'budget' => 7140000,
            ],
            [
                'project_name' => 'Operation Management System',
                'client_id' => 1, //client
                'manager_id' => 7,
                'sales_total' => 7500000,
                'budget' => 4462500,
            ],
            [
                'project_name' => 'ASE Homepage',
                'client_id' => 2, //client
                'manager_id' => 6,
                'sales_total' => 8750000,
                'budget' => 5206250,
            ],
            [
                'project_name' => 'Pivot Android App',
                'client_id' => 3, //client
                'manager_id' => 4,
                'sales_total' => 7350000,
                'budget' => 4373250,
            ],
        ];

        Project::insert($data);
    }
}