<?php

namespace App\Model\AtividadesExtraclasse;

use Illuminate\Database\Eloquent\Model;

class ExtItens extends Model
{
    public function ExtAtvTurma()
    {
        return $this->hasOne(ExtAtvTurma::class,'id','ext_atv_turmas_id');
    }
    public function ExtAtvOrcamento()
    {
        return $this->hasOne(ExtOrcamento::class,'id','ext_orcamento_id');
    }
}
