<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtAtvListaDeEsperasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_atv_lista_de_esperas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ext_atv_turmas_id');
            $table->bigInteger('aluno_id');
            $table->string('ano');
            $table->foreign('ext_atv_turmas_id')
                ->references('id')
                ->on('ext_atv_turmas')
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
        Schema::dropIfExists('ext_atv_lista_de_esperas');
    }
}
