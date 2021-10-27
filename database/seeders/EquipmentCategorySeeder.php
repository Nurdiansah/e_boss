<?php

namespace Database\Seeders;

use App\Models\EquipmentCategory;
use Illuminate\Database\Seeder;

class EquipmentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EquipmentCategory::create([
            'name' => 'Crane'
        ]);

        EquipmentCategory::create([
            'name' => 'Forklift'
        ]);

        EquipmentCategory::create([
            'name' => 'Trailer'
        ]);

        EquipmentCategory::create([
            'name' => 'Truck'
        ]);
    }
}
