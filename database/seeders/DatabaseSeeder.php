<?php

namespace Database\Seeders;

use App\Models\Salary;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ClientsTableSeeder::class,
            ProjectsTableSeeder::class,
            AssignTableSeeder::class,
            FavoriteTableSeeder::class,
            EmploymentTableSeeder::class,
            SalaryTableSeeder::class,
            EstimateTableSeeder::class,
        ]);
    }
}
