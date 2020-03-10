<?php

namespace App\Http\Controllers\AtividadesExtraclasse\Admin;

use App\Exports\CancelamentosExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AtividadesExtraclasse\ExtAtv;
use App\Model\AtividadesExtraclasse\ExtAtvCancelamento;
use App\Model\AtividadesExtraclasse\ExtAtvListaDeEspera;
use App\Model\AtividadesExtraclasse\ExtAtvTroca;
use App\Model\AtividadesExtraclasse\ExtAtvTurma;
use App\Model\AtividadesExtraclasse\ExtInscricao;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExtraclasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {   
        $cancelamentos_count = ExtAtvCancelamento::where('ano',date('Y'))->count();        
        $cancelamentos = ExtAtvCancelamento::selectRaw('ext_atvs.id,count(*) as total,ext_atvs.atividade')
        ->join('ext_atv_turmas','ext_atv_turmas_id','ext_atv_turmas.id')
        ->join('ext_atvs','ext_atv_turmas.ext_atvs_id','ext_atvs.id')
        ->groupBy('ext_atvs.id')
        ->where('ext_atv_cancelamentos.created_at','like','2020%')
        ->get();
        $ult_cancelamentos = ExtAtvCancelamento::where('ano',date('Y'))->limit(5)->orderBy('created_at','desc')->get();
        //dd($ult_cancelamentos);
        return view('admin.extraclasse.dashboard', compact('cancelamentos_count','cancelamentos','ult_cancelamentos'));
    }

    public function index()
    {
        $atv = ExtAtv::paginate(15);
        return view('admin.extraclasse.index', compact('atv'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.extraclasse.create');
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
            'atividade' => 'required|string',
            'descricao_atv' => 'required|string',
            'imagem_mini' => 'mimes:jpeg,jpg,png,gif|required|image',
            'imagem_fundo' => 'mimes:jpeg,jpg,png,gif|nullable|image',
        ],[
            'required' =>'Campo Obrigatório.',
            'image' =>'Campo deve conter uma imagem.'
        ]);             
            $imagem_mini = $request->imagem_mini->getClientOriginalName();
            $extension = $request->imagem_mini->getClientOriginalExtension();
            if($request->imagem_mini->getSize() < 2000000){
                $imagem_mini = $imagem_mini.'_'.time().'.'.$extension; 
                $request->imagem_mini->storeAs('public/uploads', $imagem_mini); 
                chmod(storage_path('app/public/uploads/').$imagem_mini, 0777);                
                $imagem_mini_url = asset('storage/uploads/'.$imagem_mini); 
            }
            if($request->hasFile('imagem_fundo')){
                $imagem_fundo = $request->imagem_fundo->getClientOriginalName();
                $extension = $request->imagem_fundo->getClientOriginalExtension();
                if($request->imagem_fundo->getSize() < 2000000){
                    $imagem_mini = $imagem_fundo.'_'.time().'.'.$extension; 
                    $request->imagem_fundo->storeAs('public/uploads', $imagem_fundo); 
                    chmod(storage_path('app/public/uploads/').$imagem_fundo, 0777);                
                    $imagem_fundo_url = asset('storage/uploads/'.$imagem_fundo); 
                }
            }
            $atv = ExtAtv::create([
                'atividade' => $request->atividade,
                'descricao' => $request->descricao_atv,
                'imagem_mini' => $imagem_mini_url,
                'imagem_fundo' => !empty($imagem_fundo_url) ? $imagem_fundo_url : null,
                'user' => Auth::user()->name
            ]);
            return redirect()->route('extclasse.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $atv = ExtAtv::find($id);
        $turmas = ExtAtvTurma::where('ext_atvs_id',$id)->get();
        $turmas_id = ExtAtvTurma::where('ext_atvs_id',$id)->select('id')->get();        
        $espera = ExtAtvListaDeEspera::whereIn('ext_atv_turmas_id',$turmas_id)->count();   
        $inscricao = ExtInscricao::whereIn('ext_atv_turmas_id',$turmas_id)->count();
        return view('admin.extraclasse.show',compact('atv','turmas','espera','inscricao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $atv = ExtAtv::find($id);
        return view('admin.extraclasse.edit',compact('atv'));
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
        $request->validate([
            'atividade' => 'required|string',
            'descricao_atv' => 'required|string',
            'imagem_mini' => 'mimes:jpeg,jpg,png,gif|nullable|image',
            'imagem_fundo' => 'mimes:jpeg,jpg,png,gif|nullable|image',
        ],[
            'required' =>'Campo Obrigatório.',
            'image' =>'Campo deve conter uma imagem.'
        ]);             
            if($request->hasFile('imagem_mini')){
                $imagem_mini = $request->imagem_mini->getClientOriginalName();
                $extension = $request->imagem_mini->getClientOriginalExtension();
                if($request->imagem_mini->getSize() < 2000000){
                    $imagem_mini = $imagem_mini.'_'.time().'.'.$extension; 
                    $request->imagem_mini->storeAs('public/uploads', $imagem_mini); 
                    chmod(storage_path('app/public/uploads/').$imagem_mini, 0777);                
                    $imagem_mini_url = asset('storage/uploads/'.$imagem_mini); 
                }
            }
            if($request->hasFile('imagem_fundo')){
                $imagem_fundo = $request->imagem_fundo->getClientOriginalName();
                $extension = $request->imagem_fundo->getClientOriginalExtension();
                if($request->imagem_fundo->getSize() < 2000000){
                    $imagem_mini = $imagem_fundo.'_'.time().'.'.$extension; 
                    $request->imagem_fundo->storeAs('public/uploads', $imagem_fundo); 
                    chmod(storage_path('app/public/uploads/').$imagem_fundo, 0777);                
                    $imagem_fundo_url = asset('storage/uploads/'.$imagem_fundo); 
                }
            }
            $atv = ExtAtv::find($id)
            ->update([
                'atividade' => $request->atividade,
                'descricao' => $request->descricao_atv,
                'imagem_mini' => !empty($imagem_mini_url) ? $imagem_mini_url : ExtAtv::find($id)->imagem_mini,
                'imagem_fundo' => !empty($imagem_fundo_url) ? $imagem_fundo_url : ExtAtv::find($id)->imagem_fundo,
                'user' => Auth::user()->name
            ]);
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

    public function ExportCancelamento(Request $request)
    {
        $request->validate([
            'ini'=>'required',
            'fim'=>'required',
        ]);       
        $dt_fim = date('Y-m-d', strtotime(str_replace('/','-',$request->fim))); 
        //dd($export);
        return Excel::download(new CancelamentosExport($request), 'Cancelados até'.$dt_fim.' 23:59:59.xlsx');
    }
}
