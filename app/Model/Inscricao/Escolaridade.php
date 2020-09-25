<?php

namespace App\Model\Inscricao;

use Illuminate\Database\Eloquent\Model;

class Escolaridade extends Model
{
    protected $connection = 'inscricao';
    protected $table = 'escolaridades';

    public function Candidatos()
    {
        return $this->hasMany(Candidato::class, 'ESCOLARIDADE_ID','ID');
    }
}
