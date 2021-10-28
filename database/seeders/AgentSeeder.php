<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agent::create([
            'name' => 'PT. Global Trans'
        ]);

        Agent::create([
            'name' => 'PT. Sinar Pagoda'
        ]);

        Agent::create([
            'name' => 'PT. Trijaya'
        ]);
    }
}
