<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtAtvPagamentosManuaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_atv_pagamentos_manuais', function (Blueprint $table) {
            $table->bigIncrements('id');            
            
            $table->unsignedBigInteger('ext_inscricao_id');  
            $table->foreign('ext_inscricao_id')
                ->references('id')
                ->on('ext_inscricaos')
                ->onDelete('cascade');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('ext_atv_pagamentos_manuais');
    }
}
