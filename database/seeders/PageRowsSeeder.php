<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PageRowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('page_rows')->truncate();
        DB::table('page_rows')->insert(['section_id' => 1, 'columns' => 1, 'column_ratio' => 1, 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
    }
}
