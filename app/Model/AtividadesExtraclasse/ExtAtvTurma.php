<?php

namespace App\Model\AtividadesExtraclasse;

use Illuminate\Database\Eloquent\Model;

class ExtAtvTurma extends Model
{
    public function turmasAut()
    {
        return $this->hasMany(ExtAtvTurmasAutorizadas::class,'ext_atv_turmas_id','id');
    }

    public function ExtAtv()
    {
        return $this->hasOne(ExtAtv::class,'id','ext_atvs_id');
    } 
    public function ExtAtvVagas($id)
    {
        $atividade = ExtAtvTurma::find($id);
        return $atividade->vagas - ExtInscricao::where('ext_atv_turmas_id',$id)->count();
    }   
    public function ExtAtvInscritos($id)
    {
        $atividade = ExtAtvTurma::find($id);
        return ExtInscricao::where('ext_atv_turmas_id',$id)->count();
    }
    public function Documentos()
    {
        return $this->hasMany(ExtAtvTurmasDocumento::class);
    }
}
