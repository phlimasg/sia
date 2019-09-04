<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ErrorUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE errors ADD tel VARCHAR(150) NULL AFTER email');
        DB::statement('ALTER TABLE errors ADD url VARCHAR(150) NULL AFTER tel');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE errors DROP tel');
        DB::statement('ALTER TABLE errors DROP url');
    }
}
