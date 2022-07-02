<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('configs')->truncate();
        DB::table('configs')->insert([
                                        'id' => 1, 
                                        'company_name' => 'TronicsPay', 
                                        'company_email' => 'tronicspay@gmail.com', 
                                        'address1' => '1214 S Noland Rd', 
                                        'address2' => '', 
                                        'city' => 'Independence', 
                                        'state' => 'MO', 
                                        'zip_code' => '64055', 
                                        'phone' => '1-816-886-7285', 
                                        'company_schedule' => '', 
                                        'good' => 20, 
                                        'fair' => 35, 
                                        'poor' => 50, 
                                        'created_at' => '2020-12-06 21:25:38', 
                                        'updated_at' => '2020-12-06 21:25:38'
                                    ]);
    }
}
