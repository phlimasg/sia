<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Totvs_Desconto extends Model
{
    protected $connection = 'totvs';
    protected $table = 'UVW_STE_Alunos_PercentualDesconto';

    protected $primaryKey = 'RA';
    protected $casts = [
        'RA' => 'int',
    ];
    protected $keyType = 'int';
    public $incrementing = false;
}
