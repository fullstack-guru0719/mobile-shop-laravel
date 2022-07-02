<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NetworksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('networks')->truncate();
        DB::table('networks')->insert(['title' => 'AT&T', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52']);
        DB::table('networks')->insert(['title' => 'Sprint', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52']);
        DB::table('networks')->insert(['title' => 'T-Mobile', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52']);
        DB::table('networks')->insert(['title' => 'Verizon', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52']);
        DB::table('networks')->insert(['title' => 'Unlocked', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52']);
    }
}
