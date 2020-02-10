<?php

namespace App\Http\Controllers;

use App\Getnet\GetnetReturn;
use App\Http\Controllers\Portal\PortalExtraclasseController;
use App\Model\AtividadesExtraclasse\ExtAtv;
use App\Model\AtividadesExtraclasse\ExtAtvTurma;
use App\Model\AtividadesExtraclasse\ExtInscricao;
use App\Model\AtividadesExtraclasse\ExtOrcamento;
use App\Model\AtividadesExtraclasse\ExtAtvListaDeEspera;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Event\HasEmitterInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;

class GetnetController extends Controller
{
    public function __construct()
    {
        session_start();
    }
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
    public function CardVerification(){
       
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post( env('GETNET_URL_API').'/v1/cards/verification',
                [
                    'headers' => [
                        'authorization' => 'Bearer '.$this->TokenGenerate()->access_token,
                        'content-type'=>'application/json; charset=utf-8',
                    ],
                    'json' => [
                        'number_token' => $this->CardTokenizer('5155901222280001')->number_token,
                        'brand'=>'mastercard',
                        'cardholder_name'=> 'JOAO DA SILVA',
                        'expiration_month'=> '10',
                        'expiration_year' => '18',
                        'security_code' => '123'
                    ]
                ]);
            $request = json_decode($response->getBody()->getContents());
            $request->code = $response->getStatusCode();
            return $request;            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }
    public function CredPayment(Request $request)
    {
        $request->validate([
            'rua' => 'required|string',
            'num' => 'numeric|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            //'estado' => 'required|string',
            'uf' => 'required|string',


            'nome' => 'required|string',
            'numero' => 'required|numeric',
            'cod' => 'required|numeric',
            'mes' => 'required|numeric',
            'ano' => 'required|numeric',
            'cart_id' => 'required|numeric'
        ],[
            'string' => 'Somente texto',
            'numeric' => 'Somente números.',
            'required' => 'Campo obrigatório'
        ]);
        try {
            $carrinho = ExtOrcamento::find($request->cart_id);
            $espera =[];
            if(Auth::user()->id == $carrinho->user_id){                
                $amount = 0;
                foreach ($carrinho->ItensCarrinho()->get() as $i) {
                    $lista = ExtAtvListaDeEspera::where('ext_atv_turmas_id',$i->ExtAtvTurma->id)->where('ano',date('Y'))->first();
                    if($i->ExtAtvTurma->ExtAtvVagas($i->ExtAtvTurma->id)>0 && empty($lista)){
                        $amount += floatval(str_replace(',','.',$i->ExtAtvTurma->valor));                        
                    }else{
                        $espera[] = 
                            [
                                'ext_atv_turmas_id' => $i->ext_atv_turmas_id,
                                'aluno_id' => $carrinho->aluno_id,
                            ];
                    }
                }       
                $amount = str_replace('.','',number_format($amount, 2, '.', ''));
    
                $client = new \GuzzleHttp\Client();
                
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
                                'order_id' => 'Atividades-Extraclasse-'.date('Y').'-'.$carrinho->id.'-'.$_SESSION['ra'],
                                //'sales_tax' => '0',
                                //'product_type' => 'service',
                                ],
                            'customer' => [
                                'customer_id' =>Auth::user()->name,
                                //'first_name'=>'Raphael',
                                //'last_name'=>'Lima',
                                //'name' => 'Raphael de Oliveira Lima',
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
                            /*'shippings'=> [                            
                                'address'=> [],
                            ],*/
                            'credit' => [
                                'delayed'=> false,
                                'save_card_data'=> false,
                                'transaction_type'=> 'FULL',
                                'number_installments'=> 1,
                                //'authenticated'=> false,
                                //'pre_authorization'=> false,
                                'soft_descriptor'=> 'Atividades Extraclasse ID '.$carrinho->id,
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

                    if(!empty($espera)){
                        foreach ($espera as $i) {                            
                            $lista_espera = new ExtAtvListaDeEspera();
                            $lista_espera->aluno_id = $i['aluno_id'];
                            $lista_espera->ext_atv_turmas_id = $i['ext_atv_turmas_id'];
                            $lista_espera->ano = date('Y');
                            $lista_espera->user_id = Auth::user()->id;
                            $lista_espera->save();
                        }
                    }
                    foreach ($carrinho->ItensCarrinho()->get() as $i) {
                        $lista = ExtAtvListaDeEspera::where('ext_atv_turmas_id',$i->ExtAtvTurma->id)->where('ano',date('Y'))->first();
                        if($i->ExtAtvTurma->ExtAtvVagas($i->ExtAtvTurma->id)>0 && empty($lista)){
                            $inscricao = new ExtInscricao();
                            $inscricao->aluno_id = $carrinho->aluno_id;
                            $inscricao->ano = date('Y');
                            $inscricao->amount = str_replace('.','',number_format(str_replace(',','.',$i->ExtAtvTurma->valor), 2, '.', ''));
                            $inscricao->ext_atv_turmas_id =$i->ExtAtvTurma->id;
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
                        }
                    }
                    $carrinho->delete();
                    return redirect()->route('aluno.show',['id' => $carrinho->aluno_id])->with('message','Inscrições efetuadas com sucesso.');
            }else{
                abort(403, 'Que feio! Você não pode fazer isso.');
            }            
                          
        } catch (RequestException  $e) {
            //$e->getRequest()
            $error = json_decode($e->getResponse()->getBody(),true);
            return redirect()->back()->with('error',$error);
            //return view('errors.error', compact('e'));
        }
    }
}
