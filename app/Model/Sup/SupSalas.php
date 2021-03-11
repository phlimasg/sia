<?php

namespace App\Model\Sup;

use Illuminate\Database\Eloquent\Model;

class SupSalas extends Model
{
    protected $fillable = ['numero','descricao','filial_id'];
}
