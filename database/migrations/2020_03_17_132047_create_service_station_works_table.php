<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceStationWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_station_works', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('service_station_id');
            $table->foreign('service_station_id')->references('id')->on('service_stations');

            $table->unsignedBigInteger('work_id');
            $table->foreign('work_id')->references('id')->on('works');

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
        Schema::dropIfExists('service_station_works');
    }
}
