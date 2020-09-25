<?php

namespace App\Http\Controllers\Inscricao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Inscricao\Candidato;
use App\Model\Inscricao\Escolaridade;
use App\Model\Inscricao\getnet_return;
use App\Model\Inscricao\Inscricao;

class InscricaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidatos = new Candidato();
        $inscricoes = new Inscricao();
        $getnet = new getnet_return();
        $escolaridade = new Escolaridade();
        return view('admin.inscricao.index',[
            'candidatos' => $candidatos,
            'inscricoes' => $inscricoes,
            'getnet' => $getnet,
            'escolaridade' =>$escolaridade
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidato = Candidato::find($id);
        return view('admin.inscricao.show',[
            'candidato' => $candidato
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
        Candidato::where('id',$id)
        ->update(['status' => $request->status]);
        return redirect()->back();
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
    public function listar()
    {
        $candidatos = Candidato::whereIn('id',
            Inscricao::select('CANDIDATO_ID')->where('PAGAMENTO',1)
            ->wherein('id',getnet_return::select('inscricaos_id')->get())
            ->get()
        )->get();        
        return view('admin.inscricao.listar',[
            'candidatos' => $candidatos
        ]);
    }
}
