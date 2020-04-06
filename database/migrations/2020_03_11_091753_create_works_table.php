<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            
            $table->unsignedBigInteger('car_id');
            $table->foreign('car_id')->references('id')->on('client_cars');

            $table->integer('price');
            $table->integer('paid')->nullable();
            $table->text('paid_comment')->nullable();
            
            $table->text('additional_information')->nullable();

            $table->text('work_json')->nullable();

            $table->tinyInteger('status')->nullable();
            $table->timestamp('ready_time')->nullable();

            $table->tinyInteger('pay_type')->nullable();

            $table->string('number_contract')->nullable();
            $table->date('date_contract')->nullable();
            
            $table->string("сertificate_install")->nullable();

            $table->string('issuing_authority')->nullable();

            $table->tinyInteger('documents_is_purchased')->default(0)->nullable();

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
        Schema::dropIfExists('works');
    }
}
