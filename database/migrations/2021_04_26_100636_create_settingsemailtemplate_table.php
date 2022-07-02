<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsemailtemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template__email', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('subject');
            $table->longText('description');
            $table->integer('scheduled_days');
            $table->string('receiver');
            $table->string('status');
            $table->string('model');
            $table->longText('content');
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
        Schema::dropIfExists('template__email');
    }
}
