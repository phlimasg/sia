<?php

namespace App\Http\Controllers\Sup;

use App\Http\Controllers\Controller;
use App\Model\Sup\SupFilial;
use Illuminate\Http\Request;

class SupFilialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filiais = SupFilial::all();
        return view('admin.suporte.filial.index', compact('filiais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.suporte.filial.create');
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
            'codigo' => 'required | numeric',
            'nome' => 'required | max:254',
        ]);
        try {
            $filial = SupFilial::create($request->except('_token'));     
            //dd($filial, $request->all())       ;
            return redirect()->route('filial.show',['filial' => $filial->id])->with('message','Salvo com sucesso');
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
    //dd($request->all(),$id);
        try {
            SupFilial::where('id',$id)
            ->update($request->except('_method','_token'));
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
