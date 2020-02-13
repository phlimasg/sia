<?php

namespace App\Http\Controllers\AtividadesExtraclasse\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AtividadesExtraclasse\ExtAtvTurma;
use App\Model\AtividadesExtraclasse\ExtAtvTurmasAutorizadas;
use App\Model\Totvs_alunos;
use Illuminate\Support\Facades\Auth;

class ExtraclasseTurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $turma = Totvs_alunos::select('TURMA','ANO')->groupBy('TURMA','ANO')->orderBy('TURMA')->get();
        return view('admin.extturma.create', compact('turma'));
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
            'descricao_turma' => 'required|max:254',
            'hora_ini' =>'required|date_format:H:i',
            'hora_fim' => 'nullable|date_format:H:i|after:hora_ini',
            'dia_libera' => 'required|date_format:d/m/Y H:i',
            'dia_bloqueia' => 'required|date_format:d/m/Y H:i|after:dia_libera',
            'vagas' => 'required|integer',
            'valor' => 'required|regex:/^\d*(\,\d{1,2})?$/',
            'turma' => 'required',
            'dias' => 'required',
            'id'=> 'required|numeric'
        ],
        [
            'required' => '*Campo Obrigatório',
            'max' => 'Tamanho máximo de 254.'
        ]);        
        try{
            $turma = new ExtAtvTurma();
            $turma->descricao_turma = $request->descricao_turma;
            $turma->hora_ini = $request->hora_ini;
            $turma->hora_fim = $request->hora_fim;
            $turma->vagas = $request->vagas;
            $turma->valor = $request->valor;
            $turma->dia_libera = $this->consertaData($request->dia_libera);
            $turma->dia_bloqueia = !empty($request->dia_bloqueia) ? $this->consertaData($request->dia_bloqueia): null;
            $turma->user = Auth::user()->email;
            $turma->ext_atvs_id = $request->id;
            foreach($request->dias as $d){
                $turma->dia .= $d.' | ';
            }
            $turma->save();            
            foreach($request->turma as $t){
                $aut = new ExtAtvTurmasAutorizadas();
                $aut->ext_atv_turmas_id = $turma->id;
                $aut->turma = $t;
                $aut->user = Auth::user()->email;
                $aut->save();
            }
            return redirect()->route('extclasse.show',['id'=> $request->id])->with('message' , 'A Turma '.$turma->descricao_turma.' foi salvo(a) com sucesso!');
        }catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($turma)
    {
        $turma = ExtAtvTurma::find($turma);
        //dd($turma);
        return view('admin.extturma.show', compact('turma'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$turma)
    {
        $atv = ExtAtvTurma::find($turma);
        //dd($atv->turmasAut);
        $turma = Totvs_alunos::select('TURMA','ANO')->groupBy('TURMA','ANO')->orderBy('TURMA')->get();
        return view('admin.extturma.edit', compact('turma','atv'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $turma)
    {  
        $request->validate([
            'descricao_turma' => 'required|max:254',
            'hora_ini' =>'required|date_format:H:i',
            'hora_fim' => 'nullable|date_format:H:i|after:hora_ini',
            'dia_libera' => 'required|date_format:d/m/Y H:i',
            'dia_bloqueia' => 'required|date_format:d/m/Y H:i|after:dia_libera',
            'vagas' => 'required|integer',
            'valor' => 'required|regex:/^\d*(\,\d{1,2})?$/',
            'turma' => 'required',
            'dias' => 'required',
            'id'=> 'required|numeric'
        ],
        [
            'required' => '*Campo Obrigatório',
            'max' => 'Tamanho máximo de 254.'
        ]);
        //dd($request->all());
        try{
            $turma = ExtAtvTurma::find($turma);
            $turma->descricao_turma = $request->descricao_turma;
            $turma->hora_ini = $request->hora_ini;
            $turma->hora_fim = $request->hora_fim;
            $turma->vagas = $request->vagas;
            $turma->valor = $request->valor;
            $turma->dia_libera = $this->consertaData($request->dia_libera);
            $turma->dia_bloqueia = !empty($request->dia_bloqueia) ? $this->consertaData($request->dia_bloqueia): null;
            $turma->user = Auth::user()->email;
            $turma->ext_atvs_id = $request->id;
            $turma->dia = null;
            foreach($request->dias as $d){
                $turma->dia .= $d.' | ';
            }
            $turma->save();
            ExtAtvTurmasAutorizadas::where('ext_atv_turmas_id',$turma->id)->delete();      
            foreach($request->turma as $t){
                $aut = new ExtAtvTurmasAutorizadas();
                $aut->ext_atv_turmas_id = $turma->id;
                $aut->turma = $t;
                $aut->user = Auth::user()->email;
                $aut->save();
            }
            return redirect()->route('extclasse.show',['id'=> $request->id])->with('message' , 'A Turma '.$turma->descricao_turma.' foi salvo(a) com sucesso!');
        }catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($turma)
    {
        //
    }
    public function consertaData($data){
        $data =  date('Y-m-d H:i',strtotime(str_replace('/','-',$data)));
        return $data;
    }
}
