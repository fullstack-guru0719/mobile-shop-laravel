<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->integer('page_id');
            $table->string('header')->nullable();
            $table->string('sub_header')->nullable();
            $table->string('background_color')->nullable();
            $table->string('background_image')->nullable();
            $table->string('class_name')->nullable();
            $table->string('header_color')->nullable();
            $table->string('sub_header_color')->nullable();
            $table->string('header_class')->nullable();
            $table->string('sub_header_class')->nullable();
            $table->integer('order_id')->nullable();
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
        Schema::dropIfExists('page_sections');
    }
}
