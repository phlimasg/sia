<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetnetReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('getnet_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment_id');
            $table->string('seller_id');
            $table->bigInteger('amount');
            $table->string('order_id');
            $table->string('status');
            $table->string('received_at');
            $table->string('authorization_code');
            $table->string('authorized_at');
            $table->string('reason_message');
            $table->string('acquirer');
            $table->string('soft_descriptor');
            $table->string('acquirer_transaction_id');
            $table->string('transaction_id');
            $table->string('code');
            $table->unsignedBigInteger('ext_inscricaos_id');
            $table->foreign('ext_inscricaos_id')
                ->references('id')
                ->on('ext_inscricaos')
                ->onDelete('cascade');
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
        Schema::dropIfExists('getnet_returns');
    }
}
