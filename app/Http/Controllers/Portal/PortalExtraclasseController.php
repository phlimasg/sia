<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Totvs_alunos;
use Illuminate\Support\Facades\Auth;

class PortalExtraclasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        try {
            $aluno = Totvs_alunos::where('RESPACADCPF',Auth::user()->name)
        ->orWhereRaw("REPLACE(REPLACE(RESPFINCPF,'.','') ,'-','') ='".Auth::user()->name."'")
        ->select('RA','CPF','NOME_ALUNO','ANO','TURMA')
        ->orderBy('NOME_ALUNO')
        ->get();

        return view('portal.extraclasse.index',compact('aluno'));
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $aluno = Totvs_alunos::where('RA','like','%'.$id)
        ->where('RESPACADCPF',Auth::user()->name)        
        ->first();
        if (is_null($aluno)) {
            $aluno = Totvs_alunos::where('RA','like','%'.$id)
            ->whereRaw("REPLACE(REPLACE(RESPFINCPF,'.','') ,'-','') ='".Auth::user()->name."'")
            ->first();            
        }
        if (is_null($aluno)) {                            
            abort(403, 'Aluno não corresponde ao Cpf do responsável');
        }else{
            return 'start season';
        }        
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
