<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupSolicitacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sup_solicitacaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('descricao');
            $table->text('solucao');            
            $table->string('status');  
            $table->unsignedBigInteger('salas_id');
            $table->foreign('salas_id')->references('id')->on('salas')->onDelete('cascade'); 
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade'); 
            $table->unsignedBigInteger('tecnico_id');
            $table->foreign('tecnico_id')->references('id')->on('tecnicos')->onDelete('cascade'); 
            $table->unsignedBigInteger('filial_id');
            $table->foreign('filial_id')->references('id')->on('filials')->onDelete('cascade'); 
            $table->unsignedBigInteger('solicitante_id');
            $table->foreign('solicitante_id')->references('id')->on('solicitantes')->onDelete('cascade'); 
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
        Schema::dropIfExists('sup_solicitacaos');
    }
}
