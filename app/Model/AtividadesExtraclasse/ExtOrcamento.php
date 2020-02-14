<?php

namespace App\Model\AtividadesExtraclasse;

use Illuminate\Database\Eloquent\Model;

class ExtOrcamento extends Model
{
    public function ItensCarrinho()
    {
        return $this->hasMany(ExtItens::class);
    }
}
