<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Client::factory(10)->create();

        $data = [
            [
                'customer_name' => 'Internal',
                'user_id' => 1,
            ],
            [
                'customer_name' => 'ASE',
                'user_id' => 1,
            ],
            [
                'customer_name' => 'PIVOT',
                'user_id' => 1,
            ],
        ];

        Client::insert($data);
    }
}
