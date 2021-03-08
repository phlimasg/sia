<?php

namespace App\Model;

use App\Model\Portal\PortalDescontoSugerido;
use Illuminate\Database\Eloquent\Model;

class Totvs_alunos extends Model
{
    protected $connection = 'totvs';
    protected $table = 'UVW_STE_ALUNOS_E_RESPONSAVEIS';

    protected $primaryKey = 'RA';
    protected $casts = [
        'RA' => 'int',
    ];
    protected $keyType = 'int';
    public $incrementing = false;
    
    public function getName($ra)
    {
        return Totvs_alunos::select('NOME_ALUNO')->where('RA',$ra)->first();
    }

    public function acesso()
    {
        return $this->hasMany(Catraca::class,'PES_NUMERO','RA');
    }
    public function findCpf()
    {
        return Totvs_alunos::where('RESPACADCPF',Auth::user()->name)
        ->orWhereRaw("REPLACE(REPLACE(RESPFINCPF,'.','') ,'-','') ='".Auth::user()->name."'")
        ->select('RA','NOME_ALUNO','ANO','TURMA')
        ->get();
    }
    public function desconto()
    {
        return $this->hasMany(Totvs_Desconto::class,'RA','RA')->whereIn('CodBolsa',[5,10,7,15,28])
        //->orWhere('Bolsa','LIKE','Bolsa Soc%')
        //->where('Servico','LIKE','Mens%')
        ;
    }
    public function descontoSugerido()
    {
        return $this->hasOne(PortalDescontoSugerido::class,'RA','ra')->orderBy('created_at');
    }
    
}
