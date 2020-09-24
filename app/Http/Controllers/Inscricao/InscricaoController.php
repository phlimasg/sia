<?php

namespace App\Http\Controllers\Inscricao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Inscricao\Candidato;
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
        //dd($getnet);
        //->Inscricao()->first()->Getnet;
        //dd($dados);
        return view('admin.inscricao.index',[
            'candidatos' => $candidatos,
            'inscricoes' => $inscricoes,
            'getnet' => $getnet,
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
