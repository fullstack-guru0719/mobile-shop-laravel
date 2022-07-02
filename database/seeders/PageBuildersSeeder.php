<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageBuildersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pagebuilder__page_translations')->delete();
        DB::table('pagebuilder__pages')->delete();

        DB::table('pagebuilder__pages')->insert(['id' => '1', 'name' => 'Landing Page', 'layout' => 'master', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52']);
        DB::table('pagebuilder__pages')->insert(['id' => '2', 'name' => 'About Us', 'layout' => 'master', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52']);
        DB::table('pagebuilder__pages')->insert(['id' => '3', 'name' => 'How It Works', 'layout' => 'master', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52']);
        DB::table('pagebuilder__pages')->insert(['id' => '4', 'name' => 'Terms and Condition', 'layout' => 'master', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52']);
        DB::table('pagebuilder__pages')->insert(['id' => '5', 'name' => 'Contact Us', 'layout' => 'master', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52']);
        DB::table('pagebuilder__pages')->insert(['id' => '6', 'name' => 'Privacy', 'layout' => 'master', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52']);


        DB::table('pagebuilder__page_translations')->insert([
            'id' => '1', 'page_id' => '1', 'locale' => 'en', 'title' => 'Landing Page', 'route' => '', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52'
        ]);
        DB::table('pagebuilder__page_translations')->insert([
            'id' => '2', 'page_id' => '2', 'locale' => 'en', 'title' => 'About Us', 'route' => 'about-us', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52'
        ]);
        DB::table('pagebuilder__page_translations')->insert([
            'id' => '3', 'page_id' => '3', 'locale' => 'en', 'title' => 'How It Works', 'route' => 'how-it-works', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52'
        ]);
        DB::table('pagebuilder__page_translations')->insert([
            'id' => '4', 'page_id' => '4', 'locale' => 'en', 'title' => 'Terms and Condition', 'route' => 'terms-and-condition', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52'
        ]);
        DB::table('pagebuilder__page_translations')->insert([
            'id' => '5', 'page_id' => '5', 'locale' => 'en', 'title' => 'Contact Us', 'route' => 'contact-us', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52'
        ]);
        DB::table('pagebuilder__page_translations')->insert([
            'id' => '6', 'page_id' => '6', 'locale' => 'en', 'title' => 'Privacy', 'route' => 'privacy', 'created_at' => '2020-12-03 07:17:52', 'updated_at' => '2020-12-03 07:17:52'
        ]);
    }
}



