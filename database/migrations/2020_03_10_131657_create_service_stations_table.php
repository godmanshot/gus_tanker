<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_stations', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("full_name")->nullable();
            $table->string("id_of_company")->nullable();
            $table->string("boss_otk")->nullable();
            $table->string("image")->nullable();
            $table->string("phone")->nullable();
            $table->string("address")->nullable();
            $table->string("currency")->nullable();
            $table->string("timezone")->nullable();
            $table->integer("warranty_exp_month")->nullable();
            $table->integer("warranty_exp_lenght")->nullable();
            $table->integer("to_period")->nullable();
            $table->string("city_name")->nullable();
            $table->string("response_person")->nullable();
            $table->longText("warranty_text")->nullable();
            $table->longText("files")->nullable();
            $table->float("balance")->nullable();
            
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
        Schema::dropIfExists('service_stations');
    }
}
