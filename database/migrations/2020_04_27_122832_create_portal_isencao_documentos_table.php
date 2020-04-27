<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortalIsencaoDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portal_isencao_documentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('url');
            $table->unsignedBigInteger('portal_isencaos_id');
            $table->foreign('portal_isencaos_id')
            ->references('id')
            ->on('portal_isencaos')
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
        Schema::dropIfExists('portal_isencao_documentos');
    }
}
