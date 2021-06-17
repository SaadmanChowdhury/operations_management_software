<?php




namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientOneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'client_name' => '社内',
                'user_id' => 1,
            ],
        ];

        Client::insert($data);
    }
}
