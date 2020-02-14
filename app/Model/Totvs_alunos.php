<?php

namespace App\Model;

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
}
