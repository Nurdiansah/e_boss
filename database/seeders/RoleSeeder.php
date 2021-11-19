<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'checker',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'admin_ops',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'spv_ops',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'asmen_ops',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'manager_ops',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'direksi',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'client',
            'guard_name' => 'web'
        ]);
    }
}
