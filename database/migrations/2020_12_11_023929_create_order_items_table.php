<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            // $table->integer('order_id');
            // $table->string('name');
            // $table->string('sku');
            // $table->integer('quantity');
            // $table->string('cost', 20);
            
            $table->integer('customer_id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('network_id');
            $table->integer('product_storage_id');
            $table->integer('quantity');
            $table->integer('device_type');
            $table->string('amount');

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
        Schema::dropIfExists('order_items');
    }
}
