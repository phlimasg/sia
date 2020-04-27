<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PortalIsencaoDeMensalidade as RequestsPortalIsencaoDeMensalidade;
use App\Http\Requests\PortalIsencaoDeMensalidadeUpdate;
use App\Model\Portal\PortalIsencao;
use App\Model\Portal\PortalIsencaoDocumento;
use App\Model\Portal\PortalMotivoIsencao;
use App\Model\Totvs_alunos;
use Exception;
use Illuminate\Support\Facades\Storage;

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
        try {
            $totvs = Totvs_alunos::where('RESPFINCPF', $request->cpf)->first();

            if (empty($totvs)){
                $e = new Exception("Não encontramos o cpf na base TOTVS");
                return view('errors.error', compact('e'));
            }                

            $insencao = PortalIsencao::create($request->except(['_token', 'upload']));
            $count = 1;
            foreach ($request->upload as $i) {
                $doc = new PortalIsencaoDocumento();
                $namefile = date('d-m-Y_H-m-s') . '_' . $count . '.' . $i->extension();
                $up = $i->storeAs('/' . 'public/uploads/desconto/' . $insencao->cpf, $namefile);
                chmod(storage_path('app/public/uploads/desconto/'),0777);
                chmod(storage_path('app/public/uploads/desconto/'.$insencao->cpf),0777);
                chmod(storage_path('app/'.$up),0777);
                $doc->nome = $i->getClientOriginalName();
                $doc->url = $up;
                $doc->portal_isencaos_id = $insencao->id;
                $doc->save();
                //dd($up, storage_path());
                //dd($up,$namefile,$doc);*/
                if (!$up)
                    return redirect()
                        ->back()
                        ->with('error', 'Falha ao fazer upload')
                        ->withInput();
                $count++;
            }
            //dd($insencao);
            return redirect()->route('solicita_flex.edit', ['id' => $insencao->cpf, 'token' => $insencao->user_token]);
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
        //        dd($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $token)
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
        try {
            $motivo = PortalMotivoIsencao::all();
            $isencao = PortalIsencao::where('cpf', $id)->where('user_token', $_GET['token'])->first();
            if(empty($isencao)){
                $e = new Exception("Solicitação não encontrada");
                return view('errors.error', compact('e'));
            }
            return view('portal.isencao.edit', compact('motivo', 'isencao'));
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PortalIsencaoDeMensalidadeUpdate $request, $id)
    {
        $isencao = PortalIsencao::where('id', $id)->where('user_token', $request->user_token)->first();
        $isencao->update([
            'motivo_id' => $request->motivo_id,
            'apelacao' => $request->apelacao
        ]);

        if(!empty($request->upload)){
            $count = 1;
            foreach ($request->upload as $i) {
                $doc = new PortalIsencaoDocumento();
                $namefile = date('d-m-Y_H-m-s') . '_' . $count . '.' . $i->extension();
                $up = $i->storeAs('/' . 'public/uploads/desconto/' . $isencao->cpf, $namefile);
                //dd(storage_path(), $up);
                chmod(storage_path('app/public/uploads/desconto/'),0777);
                chmod(storage_path('app/public/uploads/desconto/'.$isencao->cpf),0777);
                chmod(storage_path('app/'.$up),0777);
                $doc->nome = $i->getClientOriginalName();
                $doc->url = $up;
                $doc->portal_isencaos_id = $isencao->id;
                $doc->save();
                //dd($up, storage_path());
                //dd($up,$namefile,$doc);*/
                if (!$up)
                    return redirect()
                        ->back()
                        ->with('error', 'Falha ao fazer upload')
                        ->withInput();
                $count++;
            }
        
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
    public function verificacfp(Request $request)
    {
        try {
            $totvs = Totvs_alunos::where('RESPFINCPF', $request->cpf)->select('RESPFIN', 'RESPFINEMAIL', 'RESPFINCPF')->first();

            return json_encode($totvs);
        } catch (\Exception $e) {
            return json_encode($e->getMessage());
        }
    }
    public function destroyImage($id, $nome)
    {
        $file = PortalIsencaoDocumento::where('id', $id)->where('nome', $nome)->first();
        $response = Storage::delete($file->url);
        if ($response)
            $file->delete();
        return redirect()->back();
    }
}
