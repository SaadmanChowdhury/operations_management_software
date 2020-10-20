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
        Assign::factory(10)->create();
    }
}
