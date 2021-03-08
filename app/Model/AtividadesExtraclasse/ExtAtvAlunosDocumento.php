<?php

namespace App\Model\AtividadesExtraclasse;

use Illuminate\Database\Eloquent\Model;

class ExtAtvAlunosDocumento extends Model
{
    public function tipoDocumento()
    {
        return $this->hasOne(ExtAtvTurmasDocumento::class,'id','ext_atv_turmas_documento_id');
    }
}
