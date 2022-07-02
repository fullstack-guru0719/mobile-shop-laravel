<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PageSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('page_sections')->truncate();
        DB::table('page_sections')->insert([
                                            'page_id' => 5, 
                                            'header' => 'Terms & Condition', 
                                            'sub_header' => '', 
                                            'background_color' => '#EEEEEE', 
                                            'background_image' => '', 
                                            'class_name' => 'section-IhdwCKdJOg', 
                                            'header_color' => 'light', 
                                            'sub_header_color' => 'light', 
                                            'header_class' => 'header-A77bBm80Xp', 
                                            'sub_header_class' => 'sub-header-LACRIRORjB', 
                                            'order_id' => '', 
                                            'created_at' => '2020-12-07 07:49:20', 
                                            'updated_at' => '2020-12-07 07:49:20'
                                        ]);
    }
}
