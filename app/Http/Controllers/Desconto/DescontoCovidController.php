<?php

namespace App\Http\Controllers\Desconto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PortalDescontoSugeridoRequest;
use App\Mail\EmailIsencaoTrocaStatus;
use App\Model\Portal\PortalDescontoAutorizado;
use App\Model\Portal\PortalDescontoMsgInterna;
use App\Model\Portal\PortalDescontoMsgPublica;
use App\Model\Portal\PortalDescontoSugerido;
use App\Model\Portal\PortalIsencao;
use App\Model\Totvs_alunos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DescontoCovidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isencao = PortalIsencao::paginate(25);        
        return view('admin.descontos.covid.index', compact('isencao'));
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
    public function store(PortalDescontoSugeridoRequest $request)
    {
        try {
            PortalDescontoSugerido::create([
                'ra'=>$request->ra,
                'percentual'=>$request->percentual,
                'portal_isencao_id'=>$request->portal_isencao_id,
                'user_id'=>Auth::user()->id,
            ]);
            return redirect()->back();
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
        $isencao = PortalIsencao::findOrFail($id); 
        return view('admin.descontos.covid.show', compact('isencao'));
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
        $isencao = PortalIsencao::find($id);
        $isencao->status = $request->status;
        $isencao->save();
        if(!is_null($request->msg_interna))
            PortalDescontoMsgInterna::create([
                'msg_interna' => $request->msg_interna, 
                'portal_isencao_id' => $id,
                'user_id' => Auth::user()->id,   
            ]);
        if(!is_null($request->msg_usuario)){
            $msg = PortalDescontoMsgPublica::create([
                'msg_usuario' => $request->msg_usuario, 
                'portal_isencao_id' => $id,
                'user_id' => Auth::user()->id,   
            ]);
        
        }                
        if(!empty($msg)){
            Mail::to($isencao->totvs->RESPFINEMAIL)->send(new EmailIsencaoTrocaStatus($msg,$isencao));
        }
        else{
            Mail::to($isencao->totvs->RESPFINEMAIL)->send(new EmailIsencaoTrocaStatus(null,$isencao));
        }

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
    public function search(Request $request)
    {
        $isencao = new PortalIsencao();
        $isencao = PortalIsencao::where('status','like','%'.$request->status.'%')
        ->whereIn('cpf',
        Totvs_alunos::select('RESPFINCPF')->where('NOME_ALUNO','like','%'.$request->busca.'%')
        ->orWhere('RESPFIN','like','%'.$request->busca.'%')->get()
        )
        ->paginate(25);        
        return view('admin.descontos.covid.index', compact('isencao'));
    }

    public function storeAutorizado(PortalDescontoSugeridoRequest $request)
    {
        try {
            PortalDescontoAutorizado::create([
                'ra'=>$request->ra,
                'percentual'=>$request->percentual,
                'portal_isencao_id'=>$request->portal_isencao_id,
                'user_id'=>Auth::user()->id,
            ]);
            return redirect()->back();
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
    }

}
