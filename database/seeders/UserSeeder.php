<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'tronicspay@gmail.com',
            'password' => bcrypt('tronicspay'),
            'email_verified_at' => '',
            'status' => 'Active',
            'remember_token' => '',
            'created_at' => '2020-12-03 07:17:52',
            'updated_at' => '2020-12-06 20:43:08'
        ]);
    }
}
