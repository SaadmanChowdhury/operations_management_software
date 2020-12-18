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
                'client_name' => '社内',
                'user_id' => 1,
            ],
            [
                'client_name' => 'ASE',
                'user_id' => 1,
            ],
            [
                'client_name' => 'PIVOT',
                'user_id' => 1,
            ],
            [
                'client_name' => 'コトログ',
                'user_id' => 1,
            ],
            [
                'client_name' => 'BJIT',
                'user_id' => 1,
            ],
            [
                'client_name' => 'ピープル',
                'user_id' => 1,
            ],
        ];

        Client::insert($data);
    }
}