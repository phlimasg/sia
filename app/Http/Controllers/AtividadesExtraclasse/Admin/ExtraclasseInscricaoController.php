<?php

namespace App\Http\Controllers\AtividadesExtraclasse\Admin;

use App\Exports\InscricaoExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AtividadesExtraclasse\ExtInscricao;
use App\User;
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
