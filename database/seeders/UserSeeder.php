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
        $admin = User::create([
            'name' => 'Agus Cholid',
            'email' => 'agus.jakut@gmail.com',
            'password' => bcrypt('ekanuri2021')
        ]);

        $admin->assignRole('notactive');

        // superuser
        $superuser = User::create([
            'name' => 'Nurdiansah',
            'email' => 'nurdiansah@ekanuri.com',
            'password' => bcrypt('ekanuri2021')
        ]);

        $superuser->assignRole('superuser');

        // Costcontrol
        $costcontrol = User::create([
            'name' => 'E Hodijeh',
            'email' => 'admin.it@ekanuri.com',
            'password' => bcrypt('ekanuri2021')
        ]);

        $costcontrol->assignRole('costcontrol');


        // Asisten Manger OPS
        $asmen_ops = User::create([
            'name' => 'Agus Priyanto',
            'email' => 'agus@ekanuri.com',
            'password' => bcrypt('ekanuri2021')
        ]);

        $asmen_ops->assignRole('asmen_ops');


        // Manger OPS
        $manager_ops = User::create([
            'name' => 'Ari Pratama',
            'email' => 'ari@ekanuri.com',
            'password' => bcrypt('ekanuri2021')
        ]);

        $manager_ops->assignRole('manager_ops');

        //manager_finance
        $manager_finance = User::create([
            'name' => 'Rozak',
            'email' => 'rozak@ekanuri.com',
            'password' => bcrypt('ekanuri2021')
        ]);

        $manager_finance->assignRole('manager_finance');

        // direksi
        $direksi = User::create([
            'name' => 'ia',
            'email' => 'ia@ekanuri.com',
            'password' => bcrypt('ekanuri2021')
        ]);

        $direksi->assignRole('direksi');
    }
}
