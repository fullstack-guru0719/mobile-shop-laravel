<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->truncate();
        DB::table('menus')->insert(['name' => 'Home', 'menu_url' => '/', 'order_id' => 0, 'target_type' => 0, 'top_display' => 0, 'bottom_display' => 1, 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('menus')->insert(['name' => 'About Us', 'menu_url' => 'about-us', 'order_id' => 0, 'target_type' => 0, 'top_display' => 0, 'bottom_display' => 1, 'created_at' => '2020-12-07 07:49:21', 'updated_at' => '2020-12-07 07:49:21']);
        DB::table('menus')->insert(['name' => 'How It Works', 'menu_url' => 'how-it-works', 'order_id' => 0, 'target_type' => 0, 'top_display' => 0, 'bottom_display' => 1, 'created_at' => '2020-12-07 07:49:22', 'updated_at' => '2020-12-07 07:49:22']);
        DB::table('menus')->insert(['name' => 'Contact Us', 'menu_url' => 'contact-us', 'order_id' => 0, 'target_type' => 0, 'top_display' => 0, 'bottom_display' => 1, 'created_at' => '2020-12-07 07:49:23', 'updated_at' => '2020-12-07 07:49:23']);
        DB::table('menus')->insert(['name' => 'Terms and Condition', 'menu_url' => 'terms-and-condition', 'order_id' => 0, 'target_type' => 0, 'top_display' => 0, 'bottom_display' => 0, 'created_at' => '2020-12-07 07:49:24', 'updated_at' => '2020-12-07 07:49:24']);
        DB::table('menus')->insert(['name' => 'Privacy', 'menu_url' => 'privacy', 'order_id' => 0, 'target_type' => 0, 'top_display' => 0, 'bottom_display' => 0, 'created_at' => '2020-12-07 07:49:25', 'updated_at' => '2020-12-07 07:49:25']);
    }
}
