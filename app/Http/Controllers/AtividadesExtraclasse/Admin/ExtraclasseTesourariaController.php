<?php

namespace App\Http\Controllers\AtividadesExtraclasse\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GetnetController;
use App\Model\AtividadesExtraclasse\ExtAtvCancelamento;
use App\Model\AtividadesExtraclasse\ExtInscricao;
use App\Model\Totvs_alunos;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;

class ExtraclasseTesourariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('tesouraria',Auth::user());
        $inscricao = ExtInscricao::orderBy('ext_atv_turmas_id')->paginate(15);
        return view('admin.tesouraria.extraclasse.index',compact('inscricao'));
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
        $this->authorize('tesouraria',Auth::user());
        $request->validate([
            'table_search' => 'required|string'
        ]);
        //dd($request->table_search);
        $inscricao = ExtInscricao::whereIn('aluno_id',
            Totvs_alunos::select('RA')
            ->where('NOME_ALUNO','like','%'.$request->table_search.'%')
            ->get()
            )
        ->orderBy('ext_atv_turmas_id')        
        ->paginate(15);
        return view('admin.tesouraria.extraclasse.index',compact('inscricao'));
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
    public function cancelamento(Request $request)
    {
        $this->authorize('tesouraria',Auth::user());
        $request->validate([
            'id'=>'required|numeric',
            'amount' => 'nullable|string',
            'motivo' =>'required|string'            
        ]);
        try {
            $amount = str_replace(',','',str_replace(',','',$request->amount));
        
            $inscricao = ExtInscricao::find($request->id);
            
            if($request->amount <= $inscricao->amount && $amount > 0){
                $getnet = new GetnetController;            
                $client = new \GuzzleHttp\Client();
                    //dd($this->TokenGenerate());
                $response = $client->post(env('GETNET_URL_API').'/v1/payments/cancel/request',                
                    [
                        'headers' => [
                            'seller_id'=> env('GETNET_SELLER_ID'),
                            'authorization' => 'Bearer '.$getnet->TokenGenerate()->access_token,
                            'content-type'=>'application/json; charset=utf-8',
                        ],
                        'json' => [
                            'payment_id' =>$inscricao->getnet->payment_id,                            
                            'cancel_amount' => $amount,
                            'cancel_custom_key' => 'Cancel-'.date('Y-m-d-H:i').'-'.$inscricao->aluno_id,                            
                            ],
                    ]);                   
                $retorno = json_decode($response->getBody()->getContents());
                $retorno->code = $response->getStatusCode();
    
                $cancel = new ExtAtvCancelamento();
                $cancel->aluno_id = $inscricao->aluno_id;
                $cancel->ano = date('Y');
                $cancel->amount = $amount;
                $cancel->user_id = Auth::user()->id;
                $cancel->motivo = $request->motivo;
                $cancel->seller_id = $retorno->seller_id;
                $cancel->payment_id = $retorno->payment_id;
                $cancel->cancel_request_at = $retorno->cancel_request_at;
                $cancel->cancel_request_id = $retorno->cancel_request_id;
                $cancel->cancel_custom_key = $retorno->cancel_custom_key;
                $cancel->status = $retorno->status;
                $cancel->code = $retorno->code;
                $cancel->ext_atv_turmas_id = $inscricao->ext_atv_turmas_id;
                $cancel->ext_inscricaos_id = $inscricao->id;
                $cancel->save();
            }
            if($request->cancel == "on"){
                $inscricao->delete();
            }
            return redirect()->back()->with('message','Cancelamento efetuado com sucesso');
            
        } catch (RequestException  $e) {            
            $error = json_decode($e->getResponse()->getBody(),true);            
            return redirect()->back()->with('error',$error);
        }
        
    }
}
