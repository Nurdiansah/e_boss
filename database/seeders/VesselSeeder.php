<?php

namespace Database\Seeders;

use App\Models\Vessel;
use Illuminate\Database\Seeder;

class VesselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vessel::create([
            'name' => 'AHTS. ATLAS HAWK'
        ]);

        Vessel::create([
            'name' => 'AHTS. ELENA 99'
        ]);

        Vessel::create([
            'name' => 'AHTS. ERA INDONESIA'
        ]);

        Vessel::create([
            'name' => 'AHTS. GIAT JAYA'
        ]);

        Vessel::create([
            'name' => 'AHTS. INDOLIZIZ SATU'
        ]);
    }
}
