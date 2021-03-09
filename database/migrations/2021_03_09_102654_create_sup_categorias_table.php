<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sup_categorias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('descricao');
            $table->string('telegram_token')->nullable();
            $table->string('telegram_id')->nullable();
            $table->string('telegram_channel')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('sup_categorias');
    }
}
