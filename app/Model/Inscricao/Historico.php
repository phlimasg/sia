<?php

namespace App\Model\Inscricao;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $connection = 'inscricao';
    protected $table = 'historicos';
}
