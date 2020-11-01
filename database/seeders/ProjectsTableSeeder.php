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
                'customer_id' => 1, //client
                'manager_id' => 3,
                'sales_total' => 7140000,
            ],
            [
                'project_name' => 'Operation Management System',
                'customer_id' => 1, //client
                'manager_id' => 7,
                'sales_total' => 4462500,
            ],
            [
                'project_name' => 'ASE Homepage',
                'customer_id' => 2, //client
                'manager_id' => 6,
                'sales_total' => 5206250,
            ],
            [
                'project_name' => 'Pivot Android App',
                'customer_id' => 3, //client
                'manager_id' => 4,
                'sales_total' => 4373250,
            ],
        ];

        Project::insert($data);
    }
}
