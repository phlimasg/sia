<?php

namespace App\Model\AtividadesExtraclasse;

use Illuminate\Database\Eloquent\Model;

class ExtInscricao extends Model
{
    public function ExtAtvTurma()
    {
        return $this->hasOne(ExtAtvTurma::class,'id','ext_atv_turmas_id');
    }
}
