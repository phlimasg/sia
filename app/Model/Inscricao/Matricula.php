<?php

namespace App\Model\Inscricao;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $connection = 'inscricao';
    protected $table = 'matriculas';
}
