<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStorageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_storages', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('title');
            $table->decimal('excellent_offer', $precision = 8, $scale = 2)->nullable();
            $table->decimal('good_offer', $precision = 8, $scale = 2)->nullable();
            $table->decimal('fair_offer', $precision = 8, $scale = 2)->nullable();
            $table->decimal('poor_offer', $precision = 8, $scale = 2)->nullable();
            $table->decimal('amount', $precision = 8, $scale = 2)->nullable();
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
        Schema::dropIfExists('product_storages');
    }
}
