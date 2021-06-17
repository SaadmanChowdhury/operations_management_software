<?php

namespace Database\Seeders;

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

        //$this->makeDummySeeders();
        $this->startFromScratchSeeders();
    }

    public function makeDummySeeders()
    {

        $this->call([
            UsersTableSeeder::class,
            ClientsTableSeeder::class,
            ProjectsTableSeeder::class,
            AssignTableSeeder::class
        ]);
    }


    public function startFromScratchSeeders()
    {

        $this->call([
            UserOneSeeder::class,
            ClientOneSeeder::class,

        ]);
    }
}
