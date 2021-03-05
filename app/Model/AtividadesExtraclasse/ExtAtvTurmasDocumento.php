<?php

namespace App\Model\AtividadesExtraclasse;

use Illuminate\Database\Eloquent\Model;

class ExtAtvTurmasDocumento extends Model
{
    protected $fillable = [
        'documento', 'obrigatorio','ext_atv_turma_id'
    ];
}
