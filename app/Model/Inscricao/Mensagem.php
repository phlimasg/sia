<?php

namespace App\Model\Inscricao;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $connection = 'inscricao';
    protected $table = 'mensagems';

    protected $fillable = [
        'mensagem', 'CANDIDATO_ID'
    ];
}
