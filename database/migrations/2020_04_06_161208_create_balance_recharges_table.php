<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceRechargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_recharges', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('service_station_id');
            $table->foreign('service_station_id')->references('id')->on('service_stations');

            $table->float('price')->nullable();
            $table->string('uuid')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('paybox_id')->nullable();

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
        Schema::dropIfExists('balance_recharges');
    }
}
