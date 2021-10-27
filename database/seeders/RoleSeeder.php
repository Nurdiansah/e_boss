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
            'name' => 'notactive',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'superuser',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'costcontrol',
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
            'name' => 'manager_finance',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'direksi',
            'guard_name' => 'web'
        ]);
    }
}
