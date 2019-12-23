<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtAtvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_atvs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('atividade');
            $table->text('descricao');            
            $table->string('imagem_mini')->nullable();
            $table->string('imagem_fundo')->nullable();
            $table->string('user');
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
        Schema::dropIfExists('ext_atvs');
    }
}
