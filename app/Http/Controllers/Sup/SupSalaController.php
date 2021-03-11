<?php

namespace App\Http\Controllers\Sup;

use App\Http\Controllers\Controller;
use App\Model\Sup\SupFilial;
use App\Model\Sup\SupSalas;
use Illuminate\Http\Request;

class SupSalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $filial = SupFilial::findOrFail($id);
        $salas = $filial->salas;        
        return view('admin.suporte.salas.index', compact('salas','filial'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        $filial = SupFilial::findOrFail($id);
        return view('admin.suporte.salas.create',compact('filial'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id,Request $request)
    {
        $request->validate([
            'numero' => 'required | numeric',
            'descricao' => 'required | max:254',
        ]);
        try {
            //dd($id,$request->all());
            $sala = SupSalas::create($request->except('_token'));     
            //dd($filial, $request->all())       ;
            return redirect()->route('salas.show',['filial' => $id, 'sala' => $sala->id])->with('message','Salvo com sucesso');
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $filial = SupFilial::findorFail($id);
        return view('admin.suporte.filial.show',compact('filial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filial = SupFilial::find($id);   
        return view('admin.suporte.filial.update', compact('filial')); 
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
        try {
            SupFilial::update($request->all());
            return redirect()->back();
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
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
