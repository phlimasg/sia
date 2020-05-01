<?php

namespace App\Model\Portal;

use App\Model\Totvs_alunos;
use Illuminate\Database\Eloquent\Model;

class PortalIsencao extends Model
{
    protected $fillable = ['cpf', 
        'apelacao',
        'user_token',        
        'motivo_id',
    ];
    public function documentos()
    {
        return $this->hasMany(PortalIsencaoDocumento::class,'portal_isencaos_id','id');
    }
    public function totvs()
    {
        return $this->hasOne(Totvs_alunos::class,'RESPFINCPF','cpf')->select('RESPFIN','NOME_ALUNO','CPF','RESPFINEMAIL','TURMA','ANO','TURNO_ALUNO');
    }
    public function motivo()
    {
        return $this->hasOne(PortalMotivoIsencao::class,'id','motivo_id');
    }
    public function alunos()
    {
        return $this->hasMany(Totvs_alunos::class,'RESPFINCPF','cpf')->where('TURMA', 'NOT LIKE','TC%');
    }
    public function descontoSugerido($ra)
    {
        return $this->hasMany(PortalDescontoSugerido::class)->where('ra',$ra);
    }
    public function descontoAutorizado($ra)
    {
        return $this->hasMany(PortalDescontoAutorizado::class)->where('ra',$ra);
    }
    public function mensagem()
    {
        return $this->hasOne(PortalDescontoMsgPublica::class)->orderBy('created_at','desc');
    }
    public function mensagemPubAll()
    {
        return $this->hasMany(PortalDescontoMsgPublica::class,'portal_isencao_id','id')->orderBy('id','desc');
    }
    public function mensagemPubAllAsc()
    {
        return $this->hasMany(PortalDescontoMsgPublica::class,'portal_isencao_id','id')->orderBy('id','asc');
    }
    public function mensagemInternaAll()
    {
        return $this->hasMany(PortalDescontoMsgInterna::class,'portal_isencao_id','id')->orderBy('id','desc');
    }
    
}
