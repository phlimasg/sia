<?php

namespace App\Http\Controllers\AtividadesExtraclasse\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AtividadesExtraclasse\ExtAtvListaDeEspera;
use App\Model\AtividadesExtraclasse\ExtInscricao;
use App\Model\AtividadesExtraclasse\ExtItens;
use App\Model\AtividadesExtraclasse\ExtOrcamento;
use App\Model\Totvs_alunos;
use Illuminate\Support\Facades\Auth;

class PortalCarrinhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        session_start();
        //dd(ExtOrcamento::ItensCarrinho()->count());
        //$_SESSION['cart'] = ExtOrcamento::ItensCarrinho()->count();
    }
    public function index()
    {
        try {
            //code...
            $orcamento = ExtOrcamento::where('user_id',Auth::user()->id)->where('aluno_id',$_SESSION['ra'])->first();
            //$orcamento->ItensCarrinho()->get();
            return view('portal.extraclasse.carrinho.index',compact('orcamento'));
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
        
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
            'id'=>'numeric|required',
            'ra'=>'numeric|required'
        ]);
        try {
            $orcamento = ExtOrcamento::where('user_id',Auth::user()->id)->where('aluno_id',$_SESSION['ra'])->first();
            if(!empty($orcamento)){
                $_SESSION['cart'] = $orcamento->ItensCarrinho()->count();
            }
            else{
                $_SESSION['cart'] = 0;     
            }
            if($request->ra != $_SESSION['ra']){
                abort(403, 'Que feio! Você não pode fazer isso.');
            }
            $carrinho = ExtOrcamento::where('aluno_id',$request->ra)->first();
            if(!empty($carrinho->id)){  
                $itens = ExtItens::where('ext_atv_turmas_id',$request->id)->where('ext_orcamento_id',$carrinho->id)->first();
                if(!empty($itens)){
                    return redirect()->back()->with('error','Atividade já adicionada ao carrinho anteriormente.');
                }
                $lista_espera_check = ExtAtvListaDeEspera::where('aluno_id',$request->ra)->where('ext_atv_turmas_id',$request->id)->first();
                if(!empty($lista_espera_check)){
                    return redirect()->back()->with('error','Aluno já está na lista de espera.');
                }
                else{
                    $verifica_iten = ExtInscricao::where('ext_atv_turmas_id',$request->id)->where('aluno_id',$_SESSION['ra'])->where('ano',date('Y'))->first();
                    if(empty($verifica_iten)){
                        $itens = new ExtItens();
                        $itens->ext_atv_turmas_id = $request->id;
                        $itens->ext_orcamento_id = $carrinho->id;
                        $itens->save();
                    }else
                    {
                        return redirect()->back()->with('error','Aluno já inscrito nessa atividade.');
                    }
                }
            }else{
                $carrinho = new ExtOrcamento();
                $carrinho->aluno_id = $request->ra;
                $carrinho->user_id = Auth::user()->id;
                $carrinho->save();
                $itens = new ExtItens();
                $itens->ext_atv_turmas_id = $request->id;
                $itens->ext_orcamento_id = $carrinho->id;
                $itens->save();
                
            }            
            return redirect()->back()->with('message','Atividade adicionada ao carrinho.');
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
        
        try {  
            $carrinho = ExtOrcamento::find($id);
            $totvs = Totvs_alunos::where('RESPACADCPF',Auth::user()->name)
            ->orWhereRaw("REPLACE(REPLACE(RESPFINCPF,'.','') ,'-','') ='".Auth::user()->name."'")
            ->select('ENDERECO','CEP','COMPLEMENTO')
            ->first();
            $rua = explode('Nº ',$totvs->ENDERECO);
            $complemento = explode(' - ',$totvs->COMPLEMENTO);            
            $estado = explode(' / ',$complemento[1]);                       
            $endereco = [
                'rua' => !empty($rua[0])?$rua[0]:'',
                'numero' => !empty($rua[1])?$rua[1]:'',
                'bairro' => !empty($complemento[0])?$complemento[0]:'',
                'cidade' => !empty($estado[0])?$estado[0]:'',
                'uf' => !empty($estado[1])?$estado[1]:'',
                'estado' => !empty($complemento[2])?$complemento[2]:'',
                'cep' => !empty($totvs->CEP)?$totvs->CEP:''
            ];
            //dd($endereco);
            if(Auth::user()->id == $carrinho->user_id){            
                return view('portal.extraclasse.carrinho.show',compact('carrinho','endereco'));
            }else{
                abort(403, 'Que feio! Você não pode fazer isso.');
            }
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
        try {            
            if(!empty(ExtItens::find($id)->ExtAtvOrcamento()->where('aluno_id',$_SESSION['ra'])->first())){
                $return = ExtItens::find($id)->delete();
            }
            return ($return == 1) ? redirect()->back()->with('message','Removido com sucesso'):abort(403, 'Que feio! Você não pode fazer isso.');
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }        
    }
}