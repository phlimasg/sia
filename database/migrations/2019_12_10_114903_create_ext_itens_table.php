<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_itens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ext_atv_turmas_id');
            $table->foreign('ext_atv_turmas_id')
                ->references('id')
                ->on('ext_atv_turmas')
                ->onDelete('cascade');
            $table->unsignedBigInteger('ext_orcamento_id');
            $table->foreign('ext_orcamento_id')
                ->references('id')
                ->on('ext_atv_orcamentos')
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
        Schema::dropIfExists('ext_itens');
    }
}
