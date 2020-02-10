<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtAtvTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_atv_turmas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descricao_turma');
            $table->string('dia');
            $table->time('hora_ini');
            $table->time('hora_fim')->nullable();
            $table->integer('vagas');
            $table->string('valor');
            $table->dateTime('dia_libera');
            $table->dateTime('dia_bloqueia');
            $table->string('user');
            $table->unsignedBigInteger('ext_atvs_id');            
            $table->foreign('ext_atvs_id')
                ->references('id')
                ->on('ext_atvs')
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
        Schema::dropIfExists('ext_atv_turmas');
    }
}
