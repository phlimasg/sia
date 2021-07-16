<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosGvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos_gvs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('RA');
            $table->bigInteger('CPF')->nullable();
            $table->bigInteger('CODPESSOAALUNO')->nullable();
            $table->string('NOME_ALUNO');
            $table->string('EMAIL_ALUNO')->nullable();
            $table->string('CARTEIRINHA')->nullable();
            $table->string('SEXO')->nullable();
            $table->string('ANO')->nullable();
            $table->string('TURMA')->nullable();
            $table->string('TURNO_ALUNO')->nullable();
            $table->string('NUM_ALUNO')->nullable();
            $table->string('RUA')->nullable();
            $table->string('NUMERO')->nullable();
            $table->string('COMPLEMENTO')->nullable();
            $table->string('BAIRRO')->nullable();
            $table->string('CIDADE')->nullable();
            $table->string('UF')->nullable();
            $table->string('CEP')->nullable();
            $table->string('MATRICULA')->nullable();
            $table->integer('ANO_VIGENTE');
            /*$table->string('IDPERLET')->nullable();
            $table->string('CODIGO')->nullable();
            $table->string('SITUACAO')->nullable();
            $table->string('ALTERACAO')->nullable();
            $table->string('RESPACADCOD')->nullable();
            $table->string('RESPACAD')->nullable();
            $table->string('RESPACADCPF')->nullable();
            $table->string('RESPACADEMAIL')->nullable();
            $table->string('RESPACADTEL1')->nullable();
            $table->string('RESPACADTEL2')->nullable();
            $table->string('RESPACADTEL3')->nullable();
            $table->string('RESPACADDTNASCIMENTO')->nullable();
            $table->string('RESPFINCOD')->nullable();
            $table->string('RESPFIN')->nullable();
            $table->string('RESPFINCPF')->nullable();
            $table->string('RESPFINEMAIL')->nullable();
            $table->string('RESPFINTEL1')->nullable();
            $table->string('RESPFINCEL')->nullable();
            $table->string('RESPFINDTNASCIMENTO')->nullable();
            $table->string('Pai')->nullable();
            $table->string('PaiDtNasc')->nullable();
            $table->string('PaiCPF')->nullable();
            $table->string('PaiTel')->nullable();
            $table->string('Mae')->nullable();
            $table->string('MaeDtNasc')->nullable();
            $table->string('MaeCPF')->nullable();
            $table->string('MaeTel')->nullable();*/

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
        Schema::dropIfExists('alunos_gvs');
    }
}
