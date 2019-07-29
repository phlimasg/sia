<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Totvs_alunos extends Model
{
    protected $connection = 'totvs';
    protected $table = 'UVW_STE_ALUNOS_E_RESPONSAVEIS';
}
