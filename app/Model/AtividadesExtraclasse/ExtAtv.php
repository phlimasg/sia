<?php

namespace App\Model\AtividadesExtraclasse;

use Illuminate\Database\Eloquent\Model;

class ExtAtv extends Model
{
    protected $fillable=['atividade',
    'descricao',
    'imagem_mini',
    'imagem_fundo',
    'user'
];
}