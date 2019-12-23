<?php

namespace App\Model\AtividadesExtraclasse;

use Illuminate\Database\Eloquent\Model;

class ExtAtvTurma extends Model
{
    public function turmasAut()
    {
        return $this->hasMany(ExtAtvTurmasAutorizadas::class,'ext_atv_turmas_id','id');
    }
}
