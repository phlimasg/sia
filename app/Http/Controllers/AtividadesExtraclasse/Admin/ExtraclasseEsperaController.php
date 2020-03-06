<?php

namespace App\Http\Controllers\AtividadesExtraclasse\Admin;

use App\Exports\ListaDeEspera;
use App\Getnet\GetnetReturn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AutorizaListaDeEspera;
use App\Model\AtividadesExtraclasse\ExtAtvEsperaAutorizada;
use App\Model\AtividadesExtraclasse\ExtAtvListaDeEspera;
use App\Model\AtividadesExtraclasse\ExtInscricao;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class ExtraclasseEsperaController extends Controller
{
    public function TokenGenerate(){
        try {
            //code...
            $chave = 'Basic '.base64_encode(env('GETNET_CLIENT_ID').':'.env('GETNET_CLIENT_SECRET'));
            $postFields ='scope=oob&grant_type=client_credentials';
            $header = array(
                'authorization: '.$chave,
                'content-type: application/x-www-form-urlencoded',
            );
            $ch = curl_init(env('GETNET_URL_API').'/auth/oauth/v2/token');
            
            curl_setopt($ch, CURLOPT_POST, 1);
    
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
            curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
    
            $request = json_decode(curl_exec($ch));        
            curl_close($ch);
            
            return $request;
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }

    }

    public function CardTokenizer($card){
        try {
            
            $client = new \GuzzleHttp\Client();
            $response = $client->post( env('GETNET_URL_API').'/v1/tokens/card',
                [
                    'headers' => [
                        'authorization' => 'Bearer '.$this->TokenGenerate()->access_token,
                        'content-type'=>'application/json; charset=utf-8',
                    ],
                    'json' => [
                        'card_number' => $card
                    ]
                ]);
            $request = json_decode($response->getBody()->getContents());
            $request->code = $response->getStatusCode();
            return $request;            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
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
    public function downloadLista()
    {
        return Excel::download(new ListaDeEspera, 'ListaDeEspera'.date('d-m-Y H:i').'.xlsx');
    }
    public function autorizaInscricao(Request $request){
        $espera = ExtAtvListaDeEspera::findOrFail($request->id);
        $autoriza = new ExtAtvEsperaAutorizada();
        $autoriza->ext_atv_lista_de_esperas_id = $espera->id;
        $autoriza->token = date('YmdHis').Str::random(32) ;
        $autoriza->save();

        
        Mail::to($espera->aluno->RESPACADEMAIL)
        ->bcc($espera->aluno->RESPFINEMAIL)        
        ->send(new AutorizaListaDeEspera($autoriza));
        
        
        return redirect()->back()->with('message','Usuário Autorizado com sucesso!');
    }
    public function exibeListaDeEspera($id){
        $date = date('Y-m-d H:i:s');
        $date = date('Y-m-d H:i:s', strtotime('-48 hours', strtotime($date)));
        
        $autoriza = ExtAtvEsperaAutorizada::where('token',$id)
        ->whereBetween('created_at',[$date,date('Y-m-d H:i:s')])
        ->first();
        if(!empty($autoriza)){
            return view('portal.extraclasse.carrinho.esperaAutorizada',compact('autoriza'));
        }
        else{
            return '<h1>Link expirado.</h1>';
        }

        dd($autoriza);
    }
    public function pagamentoListaDeEspera(Request $request){
        $request->validate([
            'id_espera' => 'required|numeric',
            'token_autoriza' => 'required|string',
            
            'firstname' => 'sometimes|required|string',
            'lastname' => 'sometimes|required|string',
            'rua' => 'sometimes|required|string',
            'num' => 'sometimes|numeric|string',
            'bairro' => 'sometimes|required|string',
            'cidade' => 'sometimes|required|string',
            //'estado' => 'required|string',
            'uf' => 'sometimes|required|string',


            'nome' => 'sometimes|required|string',
            'numero' => 'sometimes|required|numeric',
            'cod' => 'sometimes|required|numeric',
            'mes' => 'sometimes|required|numeric|max:99',
            'ano' => 'sometimes|required|numeric|max:99',
            'cart_id' => 'sometimes|required|numeric'
        ],[
            'string' => 'Somente texto',
            'numeric' => 'Somente números.',
            'required' => 'Campo obrigatório'
        ]);
        $espera = ExtAtvEsperaAutorizada::where('ext_atv_lista_de_esperas_id',$request->id_espera)
        ->where('token', $request->token_autoriza)
        ->first();
        
        $amount = floatval(str_replace(',','.',$espera->ExtAtvListaDeEspera->ExtAtvTurma->valor));
        
        
        try {            
            if(!empty($espera)){
                if($espera->ExtAtvListaDeEspera->ExtAtvTurma->ExtAtvVagas($espera->ExtAtvListaDeEspera->ExtAtvTurma->id)>0){
                    if($amount == 0){
                        $inscricao = new ExtInscricao();
                        $inscricao->aluno_id = $espera->ExtAtvListaDeEspera->aluno_id;
                        $inscricao->ano = date('Y');
                        $inscricao->amount = str_replace('.','',number_format(str_replace(',','.',$espera->ExtAtvListaDeEspera->ExtAtvTurma->valor), 2, '.', ''));
                        $inscricao->ext_atv_turmas_id = $espera->ExtAtvListaDeEspera->ExtAtvTurma->id;
                        $inscricao->user_id = Auth::user()->id;
                        $inscricao->save();
                        ExtAtvEsperaAutorizada::destroy($espera->id);
                        ExtAtvListaDeEspera::destroy($espera->ext_atv_lista_de_esperas_id);
                        return 'Inscrição efetuada com sucesso!';

                    }else{
                        $client = new \GuzzleHttp\Client();
                    //dd($this->TokenGenerate());
                    $response = $client->post(env('GETNET_URL_API').'/v1/payments/credit',
                        [
                            'headers' => [
                                'Accept'=> 'application/json, text/plain, */*',
                                'authorization' => 'Bearer '.$this->TokenGenerate()->access_token,
                                'content-type'=>'application/json; charset=utf-8',
                            ],
                            'json' => [
                                'seller_id' =>env('GETNET_SELLER_ID'),
                                //'currency' => '',
                                'amount' => $amount,
                                'order' => [
                                    'order_id' => 'Atividades-Extraclasse-Espera'.date('Y').'-'.$espera->id.'-'.$espera->ExtAtvListaDeEspera->aluno_id,
                                    //'sales_tax' => '0',
                                    //'product_type' => 'service',
                                    ],
                                'customer' => [
                                    'customer_id' =>Auth::user()->name,
                                    'first_name'=>$request->firstname,
                                    'last_name'=>$request->lastname,
                                    //'name' => $request->firstname.' '.$request->lastname,
                                    'billing_address'=>[
                                        'street'=> $request->rua,
                                        'number'=> $request->num,
                                        //'complement'=> 'Sala 1',
                                        'district'=> $request->bairro,
                                        'city'=> $request->cidade,
                                        'state'=> $request->uf,
                                        'country'=> 'Brasil',
                                        'postal_code'=> str_replace('-','',$request->cep)                                        
                                        ],
                                    ],
                                'device' => [
                                    'ip_address'=> request()->ip(),
                                ],
                                'credit' => [
                                    'delayed'=> false,
                                    'save_card_data'=> false,
                                    'transaction_type'=> 'FULL',
                                    'number_installments'=> 1,
                                    'soft_descriptor'=> 'Atividades Extraclasse ID Espera'.$espera->id,
                                    //'dynamic_mcc'=> 1799,
                                    'card'=>[
                                        'number_token' => $this->CardTokenizer($request->numero)->number_token,
                                        'cardholder_name'=> $request->nome,
                                        'expiration_month'=> $request->mes,
                                        'expiration_year' => $request->ano,
                                        'security_code' => $request->cod,
                                        //'brand'=>'mastercard'
                                    ],
                                ],                        
                            ]
                        ]);
                       
                        $retorno = json_decode($response->getBody()->getContents());
                        $retorno->code = $response->getStatusCode();
    
                        $inscricao = new ExtInscricao();
                        $inscricao->aluno_id = $espera->ExtAtvListaDeEspera->aluno_id;
                        $inscricao->ano = date('Y');
                        $inscricao->amount = str_replace('.','',number_format(str_replace(',','.',$espera->ExtAtvListaDeEspera->ExtAtvTurma->valor), 2, '.', ''));
                        $inscricao->ext_atv_turmas_id = $espera->ExtAtvListaDeEspera->ExtAtvTurma->id;
                        $inscricao->user_id = Auth::user()->id;
                        $inscricao->save();

                        $getnet = new GetnetReturn();
                        $getnet->payment_id = $retorno->payment_id;
                        $getnet->seller_id = $retorno->seller_id;
                        $getnet->amount = $retorno->amount;
                        $getnet->order_id = $retorno->order_id;
                        $getnet->status = $retorno->status;
                        $getnet->received_at = $retorno->received_at;
                        $getnet->authorization_code = $retorno->credit->authorization_code;
                        $getnet->authorized_at = $retorno->credit->authorized_at;
                        $getnet->reason_message = $retorno->credit->reason_message;
                        $getnet->acquirer = $retorno->credit->acquirer;
                        $getnet->soft_descriptor = $retorno->credit->soft_descriptor;
                        $getnet->acquirer_transaction_id = $retorno->credit->acquirer_transaction_id;
                        $getnet->transaction_id = $retorno->credit->transaction_id;
                        $getnet->code = $retorno->code;
                        $getnet->ext_inscricaos_id = $inscricao->id;
                        $getnet->save();

                        ExtAtvEsperaAutorizada::destroy($espera->id);
                        ExtAtvListaDeEspera::destroy($espera->ext_atv_lista_de_esperas_id);
                        return 'Inscrição efetuada com sucesso!';
                    }
    
                }            
            }
        } catch (RequestException  $e) {            
            $error = json_decode($e->getResponse()->getBody(),true);            
            return redirect()->back()->with('error',$error);
        }
    }
}
