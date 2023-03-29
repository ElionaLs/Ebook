<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'address' => 'Bogor',
            'no_hp' => '08080808',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'Dwi',
            'email' => 'dwi@gmail.com',
            'password' => bcrypt('111'),
            'address' => 'cisarua',
            'no_hp' => '0889898',
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'Daniel Prawira ',
            'email' => 'danielps@gmail.com',
            'password' => bcrypt('222'),
            'address' => 'Sukasari',
            'no_hp' => '0868686',
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now()
        ]
        ]);
    }
}
