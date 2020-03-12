<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtAtvListaDeEsperaTrocasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_atv_lista_de_espera_trocas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('motivo');
            $table->bigInteger('aluno_id');
            $table->unsignedBigInteger('esperas_destino');  
            $table->foreign('esperas_destino')
                ->references('id')
                ->on('ext_atv_lista_de_esperas')
                ->onDelete('cascade');
            $table->unsignedBigInteger('esperas_origem');  
            $table->foreign('esperas_origem')
                ->references('id')
                ->on('ext_atv_lista_de_esperas')
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
        Schema::dropIfExists('ext_atv_lista_de_espera_trocas');
    }
}
