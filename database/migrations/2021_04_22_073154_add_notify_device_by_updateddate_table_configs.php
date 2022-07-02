<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotifyDeviceByUpdateddateTableConfigs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->integer('notify_device_by_last_updated_date')->after('is_dark_mode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configs', function (Blueprint $table) {
            //
        });
    }
}
