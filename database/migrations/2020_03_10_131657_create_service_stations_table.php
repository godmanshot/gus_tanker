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
            $table->string("name");
            $table->string("full_name");
            $table->string("id_of_company");
            $table->string("boss_otk");
            $table->string("image")->nullable();
            $table->string("phone");
            $table->string("address");
            $table->string("currency");
            $table->string("timezone")->nullable();
            $table->integer("warranty_exp_month");
            $table->integer("warranty_exp_lenght");
            $table->integer("to_period");
            $table->string("city_name");
            $table->string("response_person");
            $table->longText("warranty_text");
            $table->string("сertificate_install");
            $table->longText("files")->nullable();
            
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
