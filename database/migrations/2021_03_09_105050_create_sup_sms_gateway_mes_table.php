<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupSmsGatewayMesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sup_sms_gateway_mes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('device_id');
            $table->string('token');
            $table->unsignedBigInteger('filial_id');
            $table->foreign('filial_id')->references('id')->on('filials')->onDelete('cascade'); 
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
        Schema::dropIfExists('sup_sms_gateway_mes');
    }
}
