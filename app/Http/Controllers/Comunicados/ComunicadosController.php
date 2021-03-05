<?php

namespace App\Http\Controllers\Comunicados;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use App\Mail\ComunicadoMail;
use App\Model\Totvs_alunos;
use App\Model\Comunicados\comunicado;
use Illuminate\Validation\Validator;
use App\Model\Comunicados\Turma;
use App\Notifications\TelegramRegister;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ComunicadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('editor',Auth::user());
        try {
            $comunicado = comunicado::orderBy('created_at','desc')->limit(100)->get();
            return view('admin.comunicados.index', compact('comunicado'));
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $this->authorize('editor',Auth::user());
        try {
            $totvs_alunos = Totvs_alunos::select('turma','ano')->groupBy('turma','ano')->orderBy('turma')->get();
            return view('admin.comunicados.create',compact('totvs_alunos'));            
        } catch (\Exception $e) {
            return $e->getMessage();
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
        $this->authorize('editor',Auth::user());
        $request->validate([
            'titulo' => 'required|string',
            'descricao' => 'required|string',
            'turma.*' =>'required|string',
        ]);
        if(!is_array($request->turma)){   
            $errors = new MessageBag();
            $errors->add('turma', 'Turma não selecionada.');
            return back()->withErrors($errors);
        }
        try {
            $comunicado =  comunicado::create([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'user_id' =>auth()->user()->id,
            ]);
            $comunicado->save();
            
            foreach ($request->turma as $turma) {
                Turma::create([
                    'turma' => $turma,
                    'comunicado_id' =>$comunicado->id
                    ]);
            }
            if(env('APP_ENV')=='production'){
                foreach ($comunicado->turmas as $i) {
                    $totvs_alunos = Totvs_alunos::select('RA','RESPACADEMAIL','RESPFINEMAIL','EMAIL_ALUNO','NOME_ALUNO','TURMA')->where('TURMA',$i->turma)->get();
                    foreach ($totvs_alunos as $totvs) {                                            
                        SendMailJob::dispatch($totvs,$comunicado)->delay(now()->addMilliseconds(200));
                        /*
                        Mail::to('raphael.oliveira@lasalle.org.br')
                        ->cc(['raphaelpcteste@gmail.com','raphaelpc_@hotmail.com'])
                        ->queue(new ComunicadoMail($totvs, $comunicado));
                        */
                        //break;
                    }
                }
                $comunicado->notify(new TelegramRegister());
            }
            return redirect()->route('comunicados.index');            
        } catch (\Exception $e) {
            return $e->getMessage();
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
        $this->authorize('editor',Auth::user());
        try {
            $comunicado = comunicado::find($id);
            return view('admin.comunicados.show', compact('comunicado'));            
        } catch (\Exception $e) {
            return $e->getMessage();
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
        $this->authorize('editor',Auth::user());
        try {
            $comunicado= comunicado::find($id);
            //dd($comunicado->turmas);
            $totvs_alunos = Totvs_alunos::select('turma','ano')->groupBy('turma','ano')->orderBy('turma')->get();
            return view('admin.comunicados.edit', compact('comunicado','totvs_alunos'));
            //code...
        } catch (\Exception $e) {
            return $e->getMessage();
        }
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
        $this->authorize('editor',Auth::user());
        $request->validate([
            'titulo' => 'required|string',
            'descricao' => 'required|string',
            'turma.*' =>'required|string',
            ]);
            if(!is_array($request->turma)){
                $errors = new MessageBag();
                $errors->add('turma', 'Turma não selecionada.');
                return back()->withErrors($errors);
            }
            try {
                $comunicado= comunicado::find($id);
                $comunicado->titulo = $request->titulo;
                $comunicado->descricao = $request->descricao;
                $comunicado->save();
                Turma::where('comunicado_id',$comunicado->id)->delete();
                foreach ($request->turma as $turma) {
                    Turma::create([
                        'turma' => $turma,
                        'comunicado_id' =>$comunicado->id
                        ]);
                }
                return redirect()->back();            
            } catch (\Exception $e) {
                return $e->getMessage();
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('editor',Auth::user());
        try {
            comunicado::destroy($id);
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }    
}
