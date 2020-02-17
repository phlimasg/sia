<?php

namespace App\Model\AtividadesExtraclasse;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ExtOrcamento extends Model
{
    public function ItensCarrinho()
    {
        return $this->hasMany(ExtItens::class);
    }
    public function getUser()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
