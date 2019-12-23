<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtInscricaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_inscricaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('aluno_id');
            $table->integer('ano');
            $table->string('getnet_status');
            $table->string('getnet_return')->nullable();
            $table->unsignedInteger('user_id');               
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedInteger('ext_atv_turmas_id');               
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
        Schema::dropIfExists('ext_inscricaos');
    }
}
