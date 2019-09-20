<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Catraca extends Model
{
    protected $connection = 'catraca';
    protected $table = 'LOG_CREDENCIAL';

    protected $primaryKey = 'LOCR_NUMERO';
    

    public function aluno()
    {
        return $this->belongsTo(Totvs_alunos::class,'PES_NUMERO','RA');
    }
}
