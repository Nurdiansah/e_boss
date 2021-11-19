<?php

namespace Database\Seeders;

use App\Models\Port;
use Illuminate\Database\Seeder;

class PortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Port::create([
            'name' => 'Jakarta'
        ]);

        Port::create([
            'name' => 'Matak'
        ]);

        Port::create([
            'name' => 'Pabelokan'
        ]);

        Port::create([
            'name' => 'Sorong'
        ]);
    }
}
