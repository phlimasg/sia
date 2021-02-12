<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscricaoCancelamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('inscricao')->create('inscricao_cancelamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('amount');            
            $table->unsignedBigInteger('user_id');                             
            $table->unsignedBigInteger('inscricao_id');               
            $table->foreign('inscricao_id')
                ->references('id')
                ->on('inscricaos')
                ->onDelete('cascade');
            $table->unsignedBigInteger('CANDIDATO_ID');               
            $table->foreign('CANDIDATO_ID')
                ->references('id')
                ->on('candidatos')
                ->onDelete('cascade');
            $table->string('seller_id');
            $table->string('payment_id');
            $table->string('cancel_request_at');
            $table->string('cancel_request_id');
            $table->string('cancel_custom_key');
            $table->string('status');
            $table->string('code');
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
        Schema::dropIfExists('inscricao_cancelamentos');
    }
}
