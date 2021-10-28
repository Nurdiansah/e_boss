<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'name' => 'Pertamina Hulu Energi',
            'code' => 'PHE',
        ]);

        Client::create([
            'name' => 'Premier Oil',
            'code' => 'PREM',
        ]);

        Client::create([
            'name' => 'Medco Energy',
            'code' => 'MEDC',
        ]);
    }
}
