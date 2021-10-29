<?php

namespace Database\Seeders;

use App\Models\Jetty;
use Illuminate\Database\Seeder;

class JettySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jetty::create([
            'area_id' => 1,
            'name' => 'Jetty KJ1'
        ]);

        Jetty::create([
            'area_id' => 2,
            'name' => 'Jetty KJ2 A'
        ]);

        Jetty::create([
            'area_id' => 2,
            'name' => 'Jetty KJ2 B'
        ]);

        Jetty::create([
            'area_id' => 4,
            'name' => 'Jetty KJ4 A'
        ]);

        Jetty::create([
            'area_id' => 4,
            'name' => 'Jetty KJ4 B'
        ]);

        Jetty::create([
            'area_id' => 4,
            'name' => 'Jetty KJ4 C'
        ]);
    }
}
