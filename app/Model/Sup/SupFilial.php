<?php

namespace App\Model\Sup;

use Illuminate\Database\Eloquent\Model;

class SupFilial extends Model
{
    protected $fillable = ['codigo','nome'];

    public function salas()
    {
        return $this->hasMany(SupSalas::class,'filial_id','id');
    }
}
