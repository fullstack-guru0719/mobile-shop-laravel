<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDeliveryDueToNullableOnOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('orders', function (Blueprint $table) {
            $table->dateTime('delivery_due')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('orders', function (Blueprint $table) {
            $table->dateTime('delivery_due')->nullable('false')->change();
        });
    }
}
