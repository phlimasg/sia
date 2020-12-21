<?php

namespace App\Http\Controllers\Inscricao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GetnetController;
use App\Mail\ExtornoDuplicidadeInscricao;
use App\Mail\InscricaoListaDeEsperaMail;
use App\Mail\MensagemCandidatoEmail;
use App\Model\Inscricao\Candidato;
use App\Model\Inscricao\Escolaridade;
use App\Model\Inscricao\getnet_return;
use App\Model\Inscricao\Inscricao;
use App\Model\Inscricao\InscricaoCancelamento;
use App\Model\Inscricao\Mensagem;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InscricaoController extends Controller
{
    public function __construct()
    {   
//        $this->authorize('central',Auth::user());
        /*if(!Gate::check('secretaria',Auth::user()) || !Gate::check('central',Auth::user()) || !Gate::check('root',Auth::user()) || !Gate::check('supervisao_adm',Auth::user())){
            abort(403,'Não autorizado');
        }*/
    }
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
        
        if($request->mensagem){
            $candidato = Candidato::find($id);
            $mensagem = Mensagem::create([
                'mensagem' => $request->mensagem,
                'CANDIDATO_ID' => $id
            ]);            
            Mail::to($candidato->RespFin->EMAIL)->send(new MensagemCandidatoEmail($candidato));
        }        
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
        //$this->authorize('central',Auth::user());
        $candidatos = Candidato::whereIn('id',
            Inscricao::select('CANDIDATO_ID')->where('PAGAMENTO',1)
            ->wherein('id',getnet_return::select('inscricaos_id')->get())
            ->get()
        )->get();        
        return view('admin.inscricao.listar',[
            'candidatos' => $candidatos
        ]);
    }
    public function espera()
    {
        //$this->authorize('central',Auth::user());
        $escolaridade = new Escolaridade();
        $inscricoes = new Inscricao();
        $candidatos = new Candidato();        
        return view('admin.inscricao.espera.listar',[
            'candidatos' => $candidatos,
            'escolaridade' => $escolaridade,
            'inscricoes' => $inscricoes,
        ]);
    }

    public function habilitarEspera(Request $request)
    {
        //dd($request->all());
        $candidato = Candidato::find($request->id);
        $candidato->liberacao_data = date('Y-m-d H:i:s');
        $candidato->token = Str::random(32);
        $candidato->save();
        Mail::to($candidato->RespFin->EMAIL)->send(new InscricaoListaDeEsperaMail($candidato));
        return redirect()->back()->with('message','Habilitado e enviado notificação por e-mail.');
    }

    public function listar_duplicidade()
    {
        $candidatos = Candidato::
        join('inscricaos', 'candidatos.id', '=', 'inscricaos.CANDIDATO_ID')
        ->where('PAGAMENTO',1)
        ->get();
        //dd($candidatos);
        return view('admin.inscricao.cancelar.listar',[
            'candidatos' => $candidatos
        ]);
    }
    public function cancelar_duplicidade(Request $request)
    {
        try { 
            
            $duplicidade =Inscricao::where('CANDIDATO_ID',$request->CANDIDATO_ID)->count();
            $candidato = Candidato::find($request->CANDIDATO_ID);
            //dd($candidato);
            /*if($duplicidade <= 1)
                return redirect()->back()->with('message','<b>ERRO!!!</b> Só existe uma inscrição para esse candidato');*/
            
            $amount = 5000;
            $inscricao = Inscricao::find($request->id);            
            //dd($inscricao, $amount);            
            $getnet = new GetnetController;            
            $client = new \GuzzleHttp\Client();
            $response = $client->post(env('GETNET_URL_API').'/v1/payments/cancel/request',                
                [
                    'headers' => [
                        'seller_id'=> env('GETNET_SELLER_ID_EVENTOS'),
                        'authorization' => 'Bearer '.$getnet->TokenGenerateEventos()->access_token,
                        'content-type'=>'application/json; charset=utf-8',
                    ],
                    'json' => [
                        'payment_id' =>$inscricao->getnet->payment_id,                            
                        'cancel_amount' => $amount,
                        'cancel_custom_key' => 'Cancel'.date('YmdHi').'00000'.$inscricao->aluno_id,                            
                        ],
                ]);                   
            $retorno = json_decode($response->getBody()->getContents());
            $retorno->code = $response->getStatusCode();            
            $cancel = new InscricaoCancelamento();            
            $cancel->amount = $amount;
            $cancel->user_id = Auth::user()->id;
            $cancel->seller_id = !empty($retorno) ? $retorno->seller_id : 'null';
            $cancel->payment_id = !empty($retorno) ? $retorno->payment_id: 'null';
            $cancel->cancel_request_at = !empty($retorno) ? $retorno->cancel_request_at: 'null';
            $cancel->cancel_request_id = !empty($retorno) ? $retorno->cancel_request_id: 'null';
            $cancel->cancel_custom_key = !empty($retorno) ? $retorno->cancel_custom_key: 'null';
            $cancel->status = !empty($retorno) ? $retorno->status: 'null';
            $cancel->code = !empty($retorno) ? $retorno->code: 'null';            
            $cancel->inscricao_id = $inscricao->id;
            $cancel->CANDIDATO_ID = $inscricao->CANDIDATO_ID;
            $cancel->save();            
            $inscricao->destroy($request->id);
            Mail::to(Candidato::where('id',$request->CANDIDATO_ID)->first()->RespFin->EMAIL)            
            ->send(new ExtornoDuplicidadeInscricao($candidato));
            //dd($request->all(),$inscricao);
            return redirect()->back()->with('message','Cancelamento efetuado com sucesso');
            
        } catch (RequestException  $e) {            
            $error = json_decode($e->getResponse()->getBody(),true);              
            return redirect()->back()->with('message',$error);
        }
        
    }
}
