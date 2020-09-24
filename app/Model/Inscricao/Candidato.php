<?php

namespace App\Model\Inscricao;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $connection = 'inscricao';
    protected $table = 'candidatos';

    public function RespFin()
    {
        return $this->hasOne(RespFins::class,'CPF','RESPFIN_CPF');
    }    
    public function Escolaridade()
    {
        return $this->hasOne(Escolaridade::class,'ID','ESCOLARIDADE_ID');
    }
    public function Integral()
    {
        return $this->hasOne(Escolaridade::class,'ID','INTEGRAL_ID');
    }
    public function Documentos()
    {
        return $this->hasMany(Documento::class);
    }
    public function Inscricao()
    {
        return $this->hasMany(Inscricao::class,'CANDIDATO_ID','id');
    }
}
