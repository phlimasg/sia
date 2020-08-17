<?php

namespace App\Http\Controllers\AtividadesExtraclasse\Admin;

use App\Exports\InscricaoExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AtividadesExtraclasse\ExtAtvTroca;
use App\Model\AtividadesExtraclasse\ExtInscricao;
use App\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class ExtraclasseInscricaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.extraclasse.extinscricao.index');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ini'=>'required',
            'fim'=>'required',
        ]);       
        $dt_fim = date('Y-m-d', strtotime(str_replace('/','-',$request->fim))); 
        //dd($export);
        return Excel::download(new InscricaoExport($request), 'Inscritos até'.$dt_fim.' 23:59:59.xlsx');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $request->validate([
            'ra' => 'required|numeric',
            'origem' => 'required|numeric',
            'destino' => 'required|numeric',
            'motivo' => 'required|string',
        ]);
        $inscricao = ExtInscricao::find($id);
        $troca = new ExtAtvTroca();
        $troca->aluno_id = $request->ra;
        $troca->ext_atv_turmas_origem = $request->origem;
        $troca->ext_atv_turmas_destino = $request->destino;
        $troca->motivo = $request->motivo;
        $troca->user_id = Auth::user()->id;
        $troca->save();
        $inscricao->ext_atv_turmas_id = $request->destino;
        $inscricao->save();
        return redirect()->back()->with('message','Troca efetuada com sucesso.');
        dd($request->all(), $id,$inscricao);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    public function cancelamento(Request $request)
    {
        
    }
}
