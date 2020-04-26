<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PortalIsencaoDeMensalidade as RequestsPortalIsencaoDeMensalidade;
use App\Model\Portal\PortalMotivoIsencao;
use App\Model\Totvs_alunos;

class PortalIsencaoDeMensalidade extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motivo = PortalMotivoIsencao::all();
        return view('portal.isencao.index', compact('motivo'));
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
    public function store(RequestsPortalIsencaoDeMensalidade $request)
    {
        dd($request->all());
        $count=1;
        foreach ($request->upload as $i){
//            $doc = new grupoFamiliarReceitasDocumentos();
            $namefile = date('d-m-Y_H-m-s').'_'.$count.'.'.$i->extension();
            $up = $i->storeAs('/'.'upload/receitas/'.$id,$namefile);
            chmod(storage_path('/app/public/upload/receitas/'),0777);
            chmod(storage_path('/app/public/upload/receitas/'.$id),0777);
            chmod(storage_path('app/public/'.$up),0777);
            /*$doc->old_name_doc = $i->getClientOriginalName();
            $doc->url_doc = $up;
            $doc->gpo_receitas_id = $id;
            $doc->save();
            //dd($up,$namefile,$doc);*/
            if (!$up )
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            $count++;
        }
        return redirect()->back();    
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
    public function verificacfp(Request $request)
    {
        try {
            $totvs = Totvs_alunos::where('RESPFINCPF',$request->cpf)->select('RESPFIN','RESPFINEMAIL','RESPFINCPF')->first();
            
            return json_encode($totvs);
        } catch (\Exception $e) {
            return json_encode($e->getMessage());
        }

    }
}
