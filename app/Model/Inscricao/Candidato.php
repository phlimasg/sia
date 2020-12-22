<?php

namespace App\Model\Inscricao;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $connection = 'inscricao';
    protected $table = 'candidatos';
    public $timestamps = false;

    public function RespFin()
    {
        return $this->hasOne(RespFins::class,'CPF','RESPFIN_CPF');
    } 
    public function RespAcad()
    {
        return $this->hasOne(RespAcads::class,'RESPFIN_CPF','RESPFIN_CPF');
    }   
    public function Escolaridade()
    {
        return $this->hasOne(Escolaridade::class,'ID','ESCOLARIDADE_ID');
    }
    public function Cancelamento()
    {
        return $this->hasOne(InscricaoCancelamento::class,'CANDIDATO_ID','id')->latest();
    }
    public function Integral()
    {
        return $this->hasOne(Escolaridade::class,'ID','INTEGRAL_ID');
    }
    public function Documentos()
    {
        return $this->hasMany(Documento::class);
    }
    public function Inscricoes()
    {
        return $this->hasMany(Inscricao::class,'CANDIDATO_ID','id');
    }
    public function Inscricao()
    {
        return $this->hasOne(Inscricao::class,'CANDIDATO_ID','id');
    }
    public function Mensagens()
    {
        return $this->hasMany(Mensagem::class,'CANDIDATO_ID','id');
    }
}
