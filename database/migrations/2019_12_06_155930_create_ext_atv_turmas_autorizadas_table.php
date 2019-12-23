<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtAtvTurmasAutorizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_atv_turmas_autorizadas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user');
            $table->string('turma');
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
        Schema::dropIfExists('ext_atv_turmas_autorizadas');
    }
}
