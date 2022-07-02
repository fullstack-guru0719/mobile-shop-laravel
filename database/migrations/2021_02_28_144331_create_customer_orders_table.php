<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('product_id');
            $table->integer('network_id');
            $table->integer('product_storage_id');
            $table->string('amount');
            $table->string('payment_method');
            $table->string('account_username')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_bank')->nullable();
            $table->string('shipping_label')->nullable();
            $table->string('shipping_fee')->nullable();
            $table->string('tracking_code')->nullable();
            $table->integer('delivery_days')->nullable();
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
        Schema::dropIfExists('customer_orders');
    }
}
