<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->string('tracking_number');
            $table->string('carrier');
            $table->string('carrier_id')->nullable();
            $table->string('shipping_fee', 20);
            $table->integer('delivery_days');
            $table->string('shipment_id')->nullable();
            $table->string('label_url')->nullable();
            $table->date('est_delivery_date')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('shipments');
    }
}
