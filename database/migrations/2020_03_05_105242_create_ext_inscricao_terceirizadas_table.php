<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtInscricaoTerceirizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_inscricao_terceirizadas', function (Blueprint $table) {            
            $table->bigIncrements('id');
            $table->bigInteger('aluno_id');
            $table->integer('ano');            
            $table->bigInteger('amount'); 
            $table->unsignedBigInteger('user_id');               
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('ext_atv_turmas_id');               
            $table->foreign('ext_atv_turmas_id')
                ->references('id')
                ->on('ext_atv_turmas')
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
        Schema::dropIfExists('ext_inscricao_terceirizadas');
    }
}
