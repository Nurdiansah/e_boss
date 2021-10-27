<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //notactive
        $checker = User::create([
            'name' => 'Checker',
            'email' => 'checker@gmail.com',
            'password' => bcrypt('ekanuri2021')
        ]);

        $checker->assignRole('checker');

        // admin_ops
        $admin_ops = User::create([
            'name' => 'Admin Operational',
            'email' => 'admin.ops@gmail.com',
            'password' => bcrypt('ekanuri2021')
        ]);

        $admin_ops->assignRole('admin_ops');

        // Supervisor Ops
        $spv_ops = User::create([
            'name' => 'Supervisor Operational',
            'email' => 'spv.ops@gmail.com',
            'password' => bcrypt('ekanuri2021')
        ]);

        $spv_ops->assignRole('spv_ops');

        // Asisten Manger OPS
        $asmen_ops = User::create([
            'name' => 'Supervisor Operational',
            'email' => 'spv.ops@gmail.com',
            'password' => bcrypt('ekanuri2021')
        ]);

        $asmen_ops->assignRole('asmen_ops');


        // Manger OPS
        $manager_ops = User::create([
            'name' => 'Manager Operational',
            'email' => 'manager.ops@gmail.com',
            'password' => bcrypt('ekanuri2021')
        ]);

        $manager_ops->assignRole('manager_ops');

        // direksi
        $direksi = User::create([
            'name' => 'Direksi',
            'email' => 'direksi@gmail.com',
            'password' => bcrypt('ekanuri2021')
        ]);

        $direksi->assignRole('direksi');

        //client
        $client = User::create([
            'name' => 'Client',
            'email' => 'client@gmail.com',
            'password' => bcrypt('ekanuri2021')
        ]);

        $client->assignRole('client');
    }
}
