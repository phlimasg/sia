<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AlunosGv extends Model
{
    protected $primaryKey = 'RA';
    protected $casts = [
        'RA' => 'int',
    ];
    protected $fillable = [            
            'RA',
            'CPF',
            'CODPESSOAALUNO',
            'NOME_ALUNO',
            'EMAIL_ALUNO',
            'CARTEIRINHA',
            'SEXO',
            'ANO',
            'TURMA',
            'TURNO_ALUNO',
            'NUM_ALUNO',
            'RUA',
            'NUMERO',
            'COMPLEMENTO',
            'BAIRRO',
            'CIDADE',
            'UF',
            'CEP',
            'MATRICULA',
            'ANO_VIGENTE'
    ];
}
