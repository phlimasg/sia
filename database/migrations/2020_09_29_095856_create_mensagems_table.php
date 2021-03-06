<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensagemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('inscricao')->create('mensagems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('mensagem');
            $table->unsignedInteger('CANDIDATO_ID');               
            $table->foreign('CANDIDATO_ID')
                ->references('id')
                ->on('candidatos')
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
        Schema::dropIfExists('mensagems');
    }
}
