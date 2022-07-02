<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('page')->truncate();
        DB::table('page')->insert(['title' => 'Main Page', 'slug_title' => 'main-page', 'background_color' => '#FFFFFF', 'background_image' => '', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('page')->insert(['title' => 'About Us', 'slug_title' => 'about-us', 'background_color' => '#EEEEEE', 'background_image' => '', 'created_at' => '2020-12-07 07:49:21', 'updated_at' => '2020-12-07 07:49:21']);
        DB::table('page')->insert(['title' => 'How It Works', 'slug_title' => 'how-it-works', 'background_color' => '#EEEEEE', 'background_image' => '', 'created_at' => '2020-12-07 07:49:22', 'updated_at' => '2020-12-07 07:49:22']);
        DB::table('page')->insert(['title' => 'Contact Us', 'slug_title' => 'contact-us', 'background_color' => '#EEEEEE', 'background_image' => '', 'created_at' => '2020-12-07 07:49:23', 'updated_at' => '2020-12-07 07:49:23']);
        DB::table('page')->insert(['title' => 'Terms and Condition', 'slug_title' => 'terms-and-condition', 'background_color' => '#EEEEEE', 'background_image' => '', 'created_at' => '2020-12-07 07:49:24', 'updated_at' => '2020-12-07 07:49:24']);
        DB::table('page')->insert(['title' => 'Privacy', 'slug_title' => 'privacy', 'background_color' => '#eee', 'background_image' => '', 'created_at' => '.2020-12-07 07:49:25', 'updated_at' => '2020-12-07 07:49:25']);
    }
}
