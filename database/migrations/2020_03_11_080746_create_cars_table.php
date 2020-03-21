<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_cars', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('model_id');
            $table->foreign('model_id')->references('id')->on('car_models');

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');

            $table->integer('year_manufacture');
            $table->integer('cylinders');
            $table->string('vin')->nullable();
            $table->string('government_number')->nullable();
            $table->string('body_number')->nullable();
            $table->string('chassis')->nullable();
            $table->string('data_sheet')->nullable();
            $table->integer('auto_length')->nullable();
            
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
        Schema::dropIfExists('client_cars');
    }
}
