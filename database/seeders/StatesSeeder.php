<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->truncate();
        DB::table('states')->insert(['name' => 'Alaska', 'abbr' => 'AK', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('states')->insert(['name' => 'Arizona', 'abbr' => 'AZ', 'created_at' => '2020-12-07 07:49:21', 'updated_at' => '2020-12-07 07:49:21']);
        DB::table('states')->insert(['name' => 'Arkansas', 'abbr' => 'AR', 'created_at' => '2020-12-07 07:49:22', 'updated_at' => '2020-12-07 07:49:22']);
        DB::table('states')->insert(['name' => 'California', 'abbr' => 'CA', 'created_at' => '2020-12-07 07:49:23', 'updated_at' => '2020-12-07 07:49:23']);
        DB::table('states')->insert(['name' => 'Colorado', 'abbr' => 'CO', 'created_at' => '2020-12-07 07:49:24', 'updated_at' => '2020-12-07 07:49:24']);
        DB::table('states')->insert(['name' => 'Connecticut', 'abbr' => 'CT', 'created_at' => '2020-12-07 07:49:25', 'updated_at' => '2020-12-07 07:49:25']);
        DB::table('states')->insert(['name' => 'Delaware', 'abbr' => 'DE', 'created_at' => '2020-12-07 07:49:26', 'updated_at' => '2020-12-07 07:49:26']);
        DB::table('states')->insert(['name' => 'Florida', 'abbr' => 'FL', 'created_at' => '2020-12-07 07:49:27', 'updated_at' => '2020-12-07 07:49:27']);
        DB::table('states')->insert(['name' => 'Georgia', 'abbr' => 'GA', 'created_at' => '2020-12-07 07:49:28', 'updated_at' => '2020-12-07 07:49:28']);
        DB::table('states')->insert(['name' => 'Hawaii', 'abbr' => 'HI', 'created_at' => '2020-12-07 07:49:29', 'updated_at' => '2020-12-07 07:49:29']);
        DB::table('states')->insert(['name' => 'Idaho', 'abbr' => 'ID', 'created_at' => '2020-12-07 07:49:30', 'updated_at' => '2020-12-07 07:49:30']);
        DB::table('states')->insert(['name' => 'Illinois', 'abbr' => 'IL', 'created_at' => '2020-12-07 07:49:31', 'updated_at' => '2020-12-07 07:49:31']);
        DB::table('states')->insert(['name' => 'Indiana', 'abbr' => 'IN', 'created_at' => '2020-12-07 07:49:32', 'updated_at' => '2020-12-07 07:49:32']);
        DB::table('states')->insert(['name' => 'Iowa', 'abbr' => 'IA', 'created_at' => '2020-12-07 07:49:33', 'updated_at' => '2020-12-07 07:49:33']);
        DB::table('states')->insert(['name' => 'Kansas', 'abbr' => 'KS', 'created_at' => '2020-12-07 07:49:34', 'updated_at' => '2020-12-07 07:49:34']);
        DB::table('states')->insert(['name' => 'Kentucky', 'abbr' => 'KY', 'created_at' => '2020-12-07 07:49:35', 'updated_at' => '2020-12-07 07:49:35']);
        DB::table('states')->insert(['name' => 'Louisiana', 'abbr' => 'LA', 'created_at' => '2020-12-07 07:49:36', 'updated_at' => '2020-12-07 07:49:36']);
        DB::table('states')->insert(['name' => 'Maine', 'abbr' => 'ME', 'created_at' => '2020-12-07 07:49:37', 'updated_at' => '2020-12-07 07:49:37']);
        DB::table('states')->insert(['name' => 'Maryland', 'abbr' => 'MD', 'created_at' => '2020-12-07 07:49:38', 'updated_at' => '2020-12-07 07:49:38']);
        DB::table('states')->insert(['name' => 'Massachusetts', 'abbr' => 'MA', 'created_at' => '2020-12-07 07:49:39', 'updated_at' => '2020-12-07 07:49:39']);
        DB::table('states')->insert(['name' => 'Michigan', 'abbr' => 'MI', 'created_at' => '2020-12-07 07:49:40', 'updated_at' => '2020-12-07 07:49:40']);
        DB::table('states')->insert(['name' => 'Minnesota', 'abbr' => 'MN', 'created_at' => '2020-12-07 07:49:41', 'updated_at' => '2020-12-07 07:49:41']);
        DB::table('states')->insert(['name' => 'Mississippi', 'abbr' => 'MS', 'created_at' => '2020-12-07 07:49:42', 'updated_at' => '2020-12-07 07:49:42']);
        DB::table('states')->insert(['name' => 'Missouri', 'abbr' => 'MO', 'created_at' => '2020-12-07 07:49:43', 'updated_at' => '2020-12-07 07:49:43']);
        DB::table('states')->insert(['name' => 'Montana', 'abbr' => 'MT', 'created_at' => '2020-12-07 07:49:44', 'updated_at' => '2020-12-07 07:49:44']);
    }
}
