<?php

namespace App\Http\Controllers\CentralDeAtendiment\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Totvs_alunos;
use Illuminate\Support\Facades\Auth;

class AlunosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $this->authorize('central',Auth::user());   
        $totvs = Totvs_alunos::select('RA','NOME_ALUNO','ANO','TURMA','TURNO_ALUNO')->limit(500)->get();
        $total = Totvs_alunos::count();
        $segmento = Totvs_alunos::selectRaw('ANO, count(*) as Total')
        ->where('TURMA','not like','TC%')
        ->groupBy('ANO')
        ->orderBy('ANO','desc')
        ->get();
        //dd($total,$segmento);
        return view('admin.central.alunos.index',[
            'totvs' =>$totvs,
            'segmento' => $segmento,
            'total' => $total
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->authorize('central',Auth::user());
        $totvs = Totvs_alunos::select('RA','NOME_ALUNO','ANO','TURMA','TURNO_ALUNO')
        ->where('RA','like','%'.$request->table_search.'%')
        ->orWhere('NOME_ALUNO','like','%'.$request->table_search.'%')
        ->orWhere('RESPACAD','like','%'.$request->table_search.'%')
        ->orWhere('RESPFIN','like','%'.$request->table_search.'%')
        ->orWhere('Pai','like','%'.$request->table_search.'%')
        ->orWhere('Mae','like','%'.$request->table_search.'%')
        ->orWhere('PaiCPF','like','%'.$request->table_search.'%')
        ->orWhere('MaeCPF','like','%'.$request->table_search.'%')
        ->limit(100)
        ->get();
        return view('admin.central.alunos.index',[
            'totvs' =>$totvs
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        $this->authorize('central',Auth::user());
        $totvs = Totvs_alunos::where('RA','like','%'.$id)->first();
        //dd($totvs);
        return view('admin.central.alunos.show',[
            'totvs' =>$totvs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
