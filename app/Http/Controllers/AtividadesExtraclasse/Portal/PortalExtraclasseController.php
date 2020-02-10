<?php

namespace App\Http\Controllers\AtividadesExtraclasse\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AtividadesExtraclasse\ExtAtvTurma;
use App\Model\AtividadesExtraclasse\ExtAtvTurmasAutorizadas;
use App\Model\AtividadesExtraclasse\ExtInscricao;
use App\Model\AtividadesExtraclasse\ExtOrcamento;
use App\Model\Totvs_alunos;
use Illuminate\Support\Facades\Auth;

class PortalExtraclasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        session_start();        
    }
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
        try {       
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
                //session_start();
                $carrinho = ExtOrcamento::where('aluno_id',$id)->where('user_id',Auth::user()->id)->first();
                if(empty($carrinho)){
                    $carrinho = new ExtOrcamento();
                    $carrinho->aluno_id = $id;
                    $carrinho->user_id = Auth::user()->id;
                    $carrinho->save();
                }
                $_SESSION['ra'] = $id;                
                $_SESSION['cart'] = $carrinho->id;
                $_SESSION['name'] = $aluno->NOME_ALUNO;
                return redirect()->route('extraclasse.show',['extraclasse'=> $_SESSION['ra']]);
            }        
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
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
        try {
            $orcamento = ExtOrcamento::where('user_id',Auth::user()->id)->where('aluno_id',$_SESSION['ra'])->first();
            if(!empty($orcamento)){
                $_SESSION['cart'] = $orcamento->ItensCarrinho()->count();
            }
            else{
                $_SESSION['cart'] = 0;     
            }
            //session_start();
            if($_SESSION['ra']!=$id){
                abort(403, 'Aluno não corresponde ao Cpf do responsável');
            }
            $aluno = Totvs_alunos::select('turma')->where('RA','like','%'.$id)->first();
            $turmas = ExtAtvTurmasAutorizadas::where('turma', $aluno->turma)->get();            
            return view('portal.extraclasse.show',compact('turmas'));            
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
        
    }
    public function details($id)
    {
        try {
            $orcamento = ExtOrcamento::where('user_id',Auth::user()->id)->where('aluno_id',$_SESSION['ra'])->first();
            if(!empty($orcamento)){
                $_SESSION['cart'] = $orcamento->ItensCarrinho()->count();
            }
            else{
                $_SESSION['cart'] = 0;     
            }
            //session_start();
            $ra = $_SESSION['ra'];
            $aluno = Totvs_alunos::select('turma')->where('RA','like','%'.$ra)->first();
            $atividade = ExtAtvTurmasAutorizadas::where('id',$id)->where('turma',$aluno->turma)->first();
            if(!$atividade)
                abort(403, 'Você não tem acesso a essa atividade.');
        return view('portal.extraclasse.details', compact('atividade'));
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
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
