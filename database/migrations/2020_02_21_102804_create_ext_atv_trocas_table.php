<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtAtvTrocasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_atv_trocas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('motivo');
            $table->bigInteger('aluno_id');
            $table->unsignedBigInteger('ext_atv_turmas_destino');  
            $table->foreign('ext_atv_turmas_destino')
                ->references('id')
                ->on('ext_atv_turmas')
                ->onDelete('cascade');
            $table->unsignedBigInteger('ext_atv_turmas_origem');  
            $table->foreign('ext_atv_turmas_origem')
                ->references('id')
                ->on('ext_atv_turmas')
                ->onDelete('cascade');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ext_atv_trocas');
    }
}
