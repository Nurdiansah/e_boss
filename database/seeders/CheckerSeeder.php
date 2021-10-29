<?php

namespace Database\Seeders;

use App\Models\Checker;
use Illuminate\Database\Seeder;

class CheckerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Checker::create([
            'area_id' => '1',
            'name' => 'Mulyadi'
        ]);

        Checker::create([
            'area_id' => '4',
            'name' => 'Suryadi'
        ]);
    }
}
