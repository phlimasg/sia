<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortalIsencaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portal_isencaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cpf'); 
            $table->string('user_token'); 
            $table->string('status')->default('Em Análise'); 
            $table->text('apelacao');
            $table->string('sugerido')->nullable(); 
            $table->string('aprovado')->nullable(); 
            $table->unsignedBigInteger('motivo_id');
            $table->foreign('motivo_id')
                ->references('id')
                ->on('portal_motivo_isencaos')
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
        Schema::dropIfExists('portal_isencaos');
    }
}
