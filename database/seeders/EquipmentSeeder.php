<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipment::create([
            'equipmentcategory_id' => 1,
            'area_id' => 1,
            'name' => 'Crane R34 cap 60 Ton',
            'capacity' => 60.00,
            'status' => 'Ready'
        ]);

        Equipment::create([
            'equipmentcategory_id' => 1,
            'area_id' => 1,
            'name' => 'Crane R36 cap 110 Ton',
            'capacity' => 110.00,
            'status' => 'Ready'
        ]);

        Equipment::create([
            'equipmentcategory_id' => 2,
            'area_id' => 1,
            'name' => 'F10',
            'capacity' => 15.00,
            'status' => 'Ready'
        ]);
    }
}
