<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtAtvEsperaAutorizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_atv_espera_autorizadas', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('token');
            $table->unsignedBigInteger('ext_atv_lista_de_esperas_id');
            $table->foreign('ext_atv_lista_de_esperas_id')
                ->references('id')
                ->on('ext_atv_lista_de_esperas')
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
        Schema::dropIfExists('ext_atv_espera_autorizadas');
    }
}
