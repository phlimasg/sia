<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortalDescontoMsgPublicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portal_desconto_msg_publicas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('msg_usuario');            
            $table->unsignedBigInteger('portal_isencao_id');
            $table->foreign('portal_isencao_id')
            ->references('id')
            ->on('portal_isencaos')
            ->onDelete('cascade'); 
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('portal_desconto_msg_publicas');
    }
}
