<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sup_salas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero');
            $table->string('descricao')->nullable();            
            $table->unsignedBigInteger('filial_id');
            $table->foreign('filial_id')->references('id')->on('filials')->onDelete('cascade'); 
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
        Schema::dropIfExists('sup_salas');
    }
}
