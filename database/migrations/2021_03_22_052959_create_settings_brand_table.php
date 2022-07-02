<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('device_type');
            $table->string('photo')->nullable();
            $table->string('full_size')->nullable();
            $table->integer('feature')->default(1)->nullable();
            $table->integer('user_create');
            $table->integer('user_update');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings_brands');
    }
}
