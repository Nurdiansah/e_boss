<?php

namespace Database\Seeders;

use App\Models\ItemMaster;
use Illuminate\Database\Seeder;

class ItemMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ItemMaster::create([
            'name' => 'CONTAINER 20 FT',
            'long' => 6.06,
            'widht' => 2.44,
            'height' => 2.90,
            'volume' => 42.88,
            'unit' => 'UNIT',
            'area_id' => 1,
        ]);

        ItemMaster::create([
            'name' => 'CONTAINER 10 FT',
            'long' => 2.99,
            'widht' => 2.44,
            'height' => 2.59,
            'volume' => 18.90,
            'unit' => 'UNIT',
            'area_id' => 1,
        ]);

        ItemMaster::create([
            'name' => 'TOTE THANK POI',
            'long' => 1.82,
            'widht' => 1.82,
            'height' => 2.75,
            'volume' => 9.11,
            'unit' => 'UNIT',
            'area_id' => 1,
        ]);
    }
}
