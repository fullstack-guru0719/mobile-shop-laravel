<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('module');
            $table->string('email_sending')->default('Disable');
            $table->longText('template');
            $table->string('badge');
            $table->boolean('default')->default(true);
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
        Schema::dropIfExists('settings_status');
    }
}
