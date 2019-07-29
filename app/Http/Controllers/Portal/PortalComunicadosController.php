<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Comunicados\comunicado;
use Illuminate\Support\Facades\Auth;
use App\Model\Totvs_alunos;

class PortalComunicadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    
    public function index()
    {
//        dd(Auth::user()->profile->name);
        $this->authorize('portal',Auth::user());
        $comunicado = comunicado::orderBy('comunicados.created_at','desc')
        ->select('comunicados.titulo','comunicados.descricao','comunicados.id','comunicados.created_at')
        ->join('turmas','comunicados.id','=','turmas.comunicado_id')
        ->groupBy('comunicados.titulo','comunicados.descricao','comunicados.id','comunicados.created_at')
        ->whereIn('turmas.turma',
            Totvs_alunos::select('turma')
            ->whereRaw("REPLACE(REPLACE(respacadcpf,'.',''),'-','') = '". Auth::user()->name ."'")
            ->orWhereRaw("REPLACE(REPLACE(respfincpf,'.',''),'-','') = '". Auth::user()->name ."'")
            ->orWhereRaw("REPLACE(REPLACE(ra,'.',''),'-','') = '". Auth::user()->name ."'")
            //->where('respacadcpf',Auth::user()->name)
            //->orWhere('respfincpf',Auth::user()->name)
            ->get()
        )
        ->paginate(15);
        return view('portal.comunicados.index',compact('comunicado'));
        
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
        $this->authorize('portal',Auth::user());
        $comunicado = comunicado::find($id);
        //dd($comunicado->turmas);
        return view('portal.comunicados.show', compact('comunicado'));
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
