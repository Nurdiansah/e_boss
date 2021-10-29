<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AgentSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EquipmentCategorySeeder::class);
        $this->call(EquipmentSeeder::class);
        $this->call(ItemMasterSeeder::class);
        $this->call(VesselSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(PortSeeder::class);
        $this->call(StevedoringCategorySeeder::class);
    }
}
