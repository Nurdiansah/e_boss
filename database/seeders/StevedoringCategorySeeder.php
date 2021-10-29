<?php

namespace Database\Seeders;

use App\Models\StevedoringCategory;
use Illuminate\Database\Seeder;

class StevedoringCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StevedoringCategory::create([
            'name' => 'Loading'
        ]);

        StevedoringCategory::create([
            'name' => 'Offloading'
        ]);
    }
}
