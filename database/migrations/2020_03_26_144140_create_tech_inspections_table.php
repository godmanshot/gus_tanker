<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tech_inspections', function (Blueprint $table) {
            $table->id();
            $table->integer('number_ti');
            $table->longText('comment');
            $table->timestamp('time_ti');
            
            $table->unsignedBigInteger('car_id');
            $table->foreign('car_id')->references('id')->on('client_cars');
            
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');

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
        Schema::dropIfExists('tech_inspections');
    }
}
