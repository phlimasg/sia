<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddTerceirizadaField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //ALTER TABLE `ext_atvs` ADD `terceirizada` INT(1) NULL AFTER `imagem_fundo`;
        DB::statement('ALTER TABLE ext_atvs ADD terceirizada INT(1) NULL AFTER imagem_fundo');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
