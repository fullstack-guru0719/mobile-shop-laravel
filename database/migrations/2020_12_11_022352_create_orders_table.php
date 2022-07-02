<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // $table->string('order_number');
            // $table->integer('customer_id');
            // $table->string('tax', 20);
            // $table->string('sub_total', 20);
            // $table->string('shipping_fee', 20)->default(0)->nullable();
            // $table->string('total_cost', 20);
            // $table->string('status');
            // $table->string('photo')->nullable();
            
            $table->integer('customer_id');
            $table->string('order_no');
            $table->integer('status_id');
            $table->datetime('transaction_date');
            $table->datetime('delivery_due');
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
        Schema::dropIfExists('orders');
    }
}
