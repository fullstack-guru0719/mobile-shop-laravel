<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class SettingsStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings_status')->truncate();
        DB::table('settings_status')->insert(['name' => 'For Approval', 'module' => 'Order', 'email_sending' => 'Disable', 'default' => 1, 'badge' => 'label-warning']);
        DB::table('settings_status')->insert(['name' => 'Comment about order', 'module' => 'Order', 'email_sending' => 'Disable', 'default' => 1, 'badge' => 'label-info']);
        DB::table('settings_status')->insert(['name' => 'In transit', 'module' => 'Order', 'email_sending' => 'Disable', 'default' => 1, 'badge' => 'label-info']);
        DB::table('settings_status')->insert(['name' => 'On Hold', 'module' => 'Order', 'email_sending' => 'Disable', 'default' => 1, 'badge' => 'label-danger']);
        DB::table('settings_status')->insert(['name' => 'Order complete', 'module' => 'Order', 'email_sending' => 'Disable', 'default' => 1, 'badge' => 'label-success']);
        DB::table('settings_status')->insert(['name' => 'Package delivered', 'module' => 'Order', 'email_sending' => 'Disable', 'default' => 1, 'badge' => 'label-success']);
        DB::table('settings_status')->insert(['name' => 'Order submitted', 'module' => 'Order', 'email_sending' => 'Disable', 'default' => 1, 'badge' => 'label-success']);
        DB::table('settings_status')->insert(['name' => 'Shipping label created', 'module' => 'Order', 'email_sending' => 'Disable', 'default' => 1, 'badge' => 'label-info']);
        
        DB::table('settings_status')->insert(['name' => 'Complete', 'module' => 'Order', 'email_sending' => 'Disable', 'default' => 1, 'badge' => 'label-success']);
        DB::table('settings_status')->insert(['name' => 'Payment sent', 'module' => 'Order', 'email_sending' => 'Disable', 'default' => 1, 'badge' => 'label-success']);
        DB::table('settings_status')->insert(['name' => 'Follow up', 'module' => 'Order', 'email_sending' => 'Disable', 'default' => 1, 'badge' => 'label-warning']);
        DB::table('settings_status')->insert(['name' => 'Failed', 'module' => 'Order', 'email_sending' => 'Disable', 'default' => 1, 'badge' => 'label-danger']);
        DB::table('settings_status')->insert(['name' => 'Reduced offer', 'module' => 'Order', 'email_sending' => 'Disable', 'default' => 1, 'badge' => 'label-warning']);
    }
}
