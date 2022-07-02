<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings_brands')->truncate();
        DB::table('settings_brands')->insert(['name' => 'Apple', 'device_type' => 'Mobile', 'photo' => 'uploads/brands/11607356160_small.png', 'full_size' => 'uploads/brands/11607356160_full.png', 'feature' => 1, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('settings_brands')->insert(['name' => 'Samsung', 'device_type' => 'Mobile', 'photo' => 'uploads/brands/21607356179_small.png', 'full_size' => 'uploads/brands/21607356179_full.png', 'feature' => 1, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:21', 'updated_at' => '2020-12-07 07:49:21']);
        DB::table('settings_brands')->insert(['name' => 'LG', 'device_type' => 'Mobile', 'photo' => 'uploads/brands/31607356193_small.png', 'full_size' => 'uploads/brands/31607356193_full.png', 'feature' => 1, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:22', 'updated_at' => '2020-12-07 07:49:22']);
        DB::table('settings_brands')->insert(['name' => 'HTC', 'device_type' => 'Mobile', 'photo' => 'uploads/brands/41607356214_small.png', 'full_size' => 'uploads/brands/41607356214_full.png', 'feature' => 1, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:23', 'updated_at' => '2020-12-07 07:49:23']);
        DB::table('settings_brands')->insert(['name' => 'Nokia', 'device_type' => 'Mobile', 'photo' => 'uploads/brands/51607356229_small.png', 'full_size' => 'uploads/brands/51607356229_full.png', 'feature' => 1, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:24', 'updated_at' => '2020-12-07 07:49:24']);
        DB::table('settings_brands')->insert(['name' => 'Sony', 'device_type' => 'Mobile', 'photo' => 'uploads/brands/61607356244_small.png', 'full_size' => 'uploads/brands/61607356244_full.png', 'feature' => 1, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:25', 'updated_at' => '2020-12-07 07:49:25']);
        DB::table('settings_brands')->insert(['name' => 'Alcatel', 'device_type' => 'Mobile', 'photo' => 'uploads/brands/71607356259_small.png', 'full_size' => 'uploads/brands/71607356259_full.png', 'feature' => 2, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:26', 'updated_at' => '2020-12-07 07:49:26']);
        DB::table('settings_brands')->insert(['name' => 'Google', 'device_type' => 'Mobile', 'photo' => 'uploads/brands/81607356270_small.png', 'full_size' => 'uploads/brands/81607356271_full.png', 'feature' => 2, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:27', 'updated_at' => '2020-12-07 07:49:27']);
        DB::table('settings_brands')->insert(['name' => 'ZTE', 'device_type' => 'Mobile', 'photo' => 'uploads/brands/91607356283_small.png', 'full_size' => 'uploads/brands/91607356283_full.png', 'feature' => 2, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:28', 'updated_at' => '2020-12-07 07:49:28']);
        DB::table('settings_brands')->insert(['name' => 'OnePlus', 'device_type' => 'Mobile', 'photo' => 'uploads/brands/101607356299_small.png', 'full_size' => 'uploads/brands/101607356299_full.png', 'feature' => 2, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:29', 'updated_at' => '2020-12-07 07:49:29']);
        DB::table('settings_brands')->insert(['name' => 'Motorola', 'device_type' => 'Mobile', 'photo' => 'uploads/brands/111607356309_small.png', 'full_size' => 'uploads/brands/111607356309_full.png', 'feature' => 2, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:30', 'updated_at' => '2020-12-07 07:49:30']);
        DB::table('settings_brands')->insert(['name' => 'Smart Watch', 'device_type' => 'Other', 'photo' => 'uploads/brands/121607356361_small.png', 'full_size' => 'uploads/brands/121607356361_full.png', 'feature' => 3, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:31', 'updated_at' => '2020-12-07 07:49:31']);
        DB::table('settings_brands')->insert(['name' => 'Ipods', 'device_type' => 'Other', 'photo' => 'uploads/brands/131607356380_small.png', 'full_size' => 'uploads/brands/131607356380_full.png', 'feature' => 3, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:32', 'updated_at' => '2020-12-07 07:49:32']);
        DB::table('settings_brands')->insert(['name' => 'Game Devices', 'device_type' => 'Other', 'photo' => 'uploads/brands/141607356401_small.png', 'full_size' => 'uploads/brands/141607356401_full.png', 'feature' => 3, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:33', 'updated_at' => '2020-12-07 07:49:33']);
        DB::table('settings_brands')->insert(['name' => 'Ipads & Tablets', 'device_type' => 'Other', 'photo' => 'uploads/brands/151607356426_small.png', 'full_size' => 'uploads/brands/151607356426_full.png', 'feature' => 3, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:34', 'updated_at' => '2020-12-07 07:49:34']);
        DB::table('settings_brands')->insert(['name' => 'Accessories', 'device_type' => 'Other', 'photo' => 'uploads/brands/161607356440_small.png', 'full_size' => 'uploads/brands/161607356440_full.png', 'feature' => 3, 'user_create' => 1, 'user_update' => 1, 'created_at' => '2020-12-07 07:49:35', 'updated_at' => '2020-12-07 07:49:35']);

    }
}
