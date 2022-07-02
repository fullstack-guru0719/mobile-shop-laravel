<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_email')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('company_schedule')->nullable();
            $table->integer('good')->nullable();
            $table->integer('fair')->nullable();
            $table->integer('poor')->nullable();
            $table->tinyInteger('is_dark_mode');
            $table->timestamps();
        });

        DB::table('configs')->insert([
            'company_name' => 'TronicsPay',
            'company_email' => 'tronicspay@gmail.com',
            'address1' => '1214 S Noland Rd',
            'city' => 'Independence',
            'state' => 'MO',
            'zip_code' => '64055',
            'phone' => '1-816-886-7285'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
