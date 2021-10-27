<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create([
            'code_area' => 'KJ1',
            'name' => 'Kalijapat 1'
        ]);

        Area::create([
            'code_area' => 'KJ2',
            'name' => 'Kalijapat 2'
        ]);

        Area::create([
            'code_area' => 'KJ3',
            'name' => 'Kalijapat 3'
        ]);

        Area::create([
            'code_area' => 'KJ4',
            'name' => 'Kalijapat 4'
        ]);

        Area::create([
            'code_area' => 'KJ5',
            'name' => 'Kalijapat 5'
        ]);
    }
}
