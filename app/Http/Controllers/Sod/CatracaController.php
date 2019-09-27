<?php

namespace App\Http\Controllers\Sod;

use App\Exports\CatracaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Catraca;
use App\Model\Totvs_alunos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CatracaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $this->authorize('sod',Auth::user());
            //$this->authorize('sod');
            $dateini = date('d/m/Y', strtotime('0 days'));
            $datefim = date('d/m/Y', strtotime('1 days'));

            /*$catraca = Catraca::whereBetween('mov_datahora',[$dateini,$datefim])
            ->select('PES_NUMERO')
            ->whereIn('PES_NUMERO',Totvs_alunos::selectRaw("PARSE( RA As Int ) As RA")->where('TURNO_ALUNO','MANHÃ')->get())
            ->groupBy('PES_NUMERO')
            ->limit(2)
            ->get();*/                     
            
            $atrasos_M = Totvs_alunos::whereIn(DB::raw('cast([RA] as bigint)'),
                    Catraca::whereBetween('mov_datahora',[$dateini.' 07:05:00',$dateini.' 08:00:00'])                        
                        ->select('PES_NUMERO')
                        ->whereRaw('LEN(PES_NUMERO) = 5')
                        ->where('MOV_ENTRADASAIDA',1)
                        
                        ->groupBy('PES_NUMERO')->get()
                        )
                ->groupBy('TURNO_ALUNO')
                ->where('TURNO_ALUNO','MANHÃ')
                ->orWhere('TURNO_ALUNO','INTEGRAL')
            ->count();
            //dd($atrasos_M);

            $atrasos_T = Totvs_alunos::whereIn(DB::raw('cast([RA] as bigint)'),
                    Catraca::whereBetween('mov_datahora',[$dateini.' 13:05:00',$dateini.' 14:00:00'])                        
                        ->select('PES_NUMERO')
                        ->whereRaw('LEN(PES_NUMERO) = 5')
                        ->where('MOV_ENTRADASAIDA',1)
                        
                        ->groupBy('PES_NUMERO')->get()
                        )
                    ->where('TURNO_ALUNO','TARDE')             
                    ->groupBy('TURNO_ALUNO')   
                    ->count();
            //dd($atrasos);

            $falta_M = Totvs_alunos::whereIn(DB::raw('cast([RA] as bigint)'),
                    Catraca::whereBetween('mov_datahora',[$dateini.' 06:05:00',$dateini.' 09:00:00'])
                        ->select('PES_NUMERO')
                        ->where('MOV_ENTRADASAIDA',1)
                        ->whereRaw('LEN(PES_NUMERO) = 5')
                        ->groupBy('PES_NUMERO')
                        
                        ->get()
                        )
                ->where('TURNO_ALUNO','MANHÃ')
                ->whereOr('TURNO_ALUNO','INTEGRAL')
            ->count();

            $falta_T = Totvs_alunos::whereIn(DB::raw('cast([RA] as bigint)'),
                    Catraca::whereBetween('mov_datahora',[$dateini.' 11:05:00',$dateini.' 14:00:00'])
                        ->select('PES_NUMERO')
                        ->where('MOV_ENTRADASAIDA',1)
                        ->whereRaw('LEN(PES_NUMERO) = 5')
                        
                        ->groupBy('PES_NUMERO')->get()
                        )
                ->where('TURNO_ALUNO','TARDE')                
            ->count();

            

            $total =  Totvs_alunos::selectRaw('count(*) as total, TURNO_ALUNO')
            ->groupBy('TURNO_ALUNO')
            ->get();
            
            return view('sod.index', compact('total','falta_M','falta_T','atrasos_M','atrasos_T'));
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
    public function relatorio()
    {        
        $this->authorize('sod',Auth::user());
        try {            
            return view('sod.relatorio');
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
    }
    public function relatorio_gerar(Request $request)
    {
        $this->authorize('sod',Auth::user());
        
        $request->validate([
            'dt_ini' => 'required|date',
            'dt_fim' => 'required|date|after_or_equal:dt_ini',
            'hr_ini' => 'required',
            'hr_fim' => 'required',
            'escolaridade' => 'required'
        ]);
        try {
            
            /*
            $turmas = ['A','B','C','D','E','F','G','H','I','J'];
            $escolaridade=[];
            if ($request->escolaridade == 'EFER') {
                for ($i=1; $i <=5; $i++) {
                    foreach ($turmas as $t) {
                        $escolaridade[] .= 'EFER0'.$i.'A.'.$t;                        
                    }                     
                }
                $totvs = Totvs_alunos::selectRaw('cast([RA] as bigint)')->whereIn('TURMA', $escolaridade)->get();
            }elseif($request->escolaridade == 'EFERII'){
                for ($i=6; $i <=9; $i++) {
                    foreach ($turmas as $t) {
                        $escolaridade[] .= 'EFER0'.$i.'A.'.$t;                        
                    }                     
                }
                $totvs = Totvs_alunos::selectRaw('cast([RA] as bigint)')->whereIn('TURMA', $escolaridade)->get();                
            }
            else {
                $totvs = Totvs_alunos::selectRaw('cast([RA] as bigint)')->where('TURMA','like',$request->escolaridade.'%')->get();
            }*/
            
           $dateini =  date('d/m/Y', strtotime($request->dt_ini)).' '.date('H:i:s', strtotime($request->hr_ini));
           $datefim =  date('d/m/Y', strtotime($request->dt_fim)).' '.date('H:i:s', strtotime($request->hr_fim));
           
           /*
           //dd($totvs);
           $relatorio = Totvs_alunos::whereIn(DB::raw('cast([RA] as bigint)'),
                Catraca::whereBetween('mov_datahora',[$dateini,$datefim])
                ->select('PES_NUMERO')
                ->whereRaw('LEN(PES_NUMERO) = 5')
                ->whereIn('PES_NUMERO',$totvs)
                ->get()
           )->get();
           /*$relatorio = Catraca::whereBetween('mov_datahora',[$dateini,$datefim])
           ->whereRaw('LEN(PES_NUMERO) = 5')
           ->whereIn('PES_NUMERO',$totvs)
           ->get();*/
           return Excel::download(new CatracaExport($request), 'Relatório_'.$request->dt_ini.'_'.date('H:i:s', strtotime($request->hr_ini)).'_'.$request->dt_fim.'_'.date('H:i:s', strtotime($request->hr_fim)).'_'.$request->escolaridade.'.xlsx');
           
           //dd($relatorio);
           
            
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
    }
}
