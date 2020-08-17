<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtAtvCancelamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_atv_cancelamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('aluno_id');
            $table->integer('ano');  
            $table->bigInteger('amount');
            $table->text('motivo');
            $table->unsignedBigInteger('user_id');                 
            $table->string('ext_inscricaos_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('ext_atv_turmas_id');               
            $table->foreign('ext_atv_turmas_id')
                ->references('id')
                ->on('ext_atv_turmas')
                ->onDelete('cascade');
                $table->string('seller_id');
            $table->string('payment_id');
            $table->string('cancel_request_at');
            $table->string('cancel_request_id');
            $table->string('cancel_custom_key');
            $table->string('status');
            $table->string('code');
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
        Schema::dropIfExists('ext_atv_cancelamentos');
    }
}
