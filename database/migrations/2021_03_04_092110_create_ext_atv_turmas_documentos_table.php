<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtAtvTurmasDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_atv_turmas_documentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('documento');
            $table->char('obrigatorio');
            $table->unsignedBigInteger('ext_atv_turma_id');
            $table->foreign('ext_atv_turma_id')->references('id')->on('ext_atv_turmas')->onDelete('cascade');
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
        Schema::dropIfExists('ext_atv_turmas_documentos');
    }
}
