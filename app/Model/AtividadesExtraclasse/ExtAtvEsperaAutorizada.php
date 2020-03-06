<?php

namespace App\Model\AtividadesExtraclasse;

use Illuminate\Database\Eloquent\Model;

class ExtAtvEsperaAutorizada extends Model
{
    public function ExtAtvListaDeEspera()
    {
        return $this->hasOne(ExtAtvListaDeEspera::class,'id','ext_atv_lista_de_esperas_id');
    }
}
