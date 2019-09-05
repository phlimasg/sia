<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Catraca;
use App\Model\Totvs_alunos;
use Illuminate\Support\Facades\Auth;

class PortalCatracaController extends Controller
{
    public function index(){
        try {
            
            $acesso = Totvs_alunos::select('carteirinha','RA','NOME_ALUNO')->where('RA',Auth::user()->name)->get();
            if(empty($acesso->RA)){
                $acesso = Totvs_alunos::select('carteirinha','RA','NOME_ALUNO')
                ->whereRaw("REPLACE(respacadcpf,'/','')='".Auth::user()->name."'")
                ->orWhereRaw("REPLACE(REPLACE(respfincpf,'.',''),'-','') = '".Auth::user()->name."'")                
                ->get();
                //dd($acesso);
            }
            $dateini = date('d/m/Y', strtotime('-30 days'));
            $datefim = date('d/m/Y', strtotime('1 days'));
            
            $catraca = Catraca::whereIn('PES_NUMERO',Totvs_alunos::selectRaw("PARSE( RA As Int ) As RA")->where('RA',Auth::user()->name)->get())
                ->whereBetween('mov_datahora',[$dateini,$datefim])
                ->orderBy('MOV_DATAHORA','desc')
                ->get();
                if(empty($catraca->PES_NUMERO)){
                    $catraca = Catraca::whereIn('PES_NUMERO',Totvs_alunos::selectRaw("PARSE( RA As Int ) As RA")
                        ->whereRaw("REPLACE(REPLACE(respfincpf,'.',''),'-','') = '".Auth::user()->name."'")
                        ->orWhereRaw("REPLACE(respacadcpf,'/','')='".Auth::user()->name."'")
                        ->get())
                    ->whereBetween('mov_datahora',[$dateini,$datefim])
                    ->orderBy('MOV_DATAHORA','desc')
                    ->get();
                }
                //dd(Auth::user(),$acesso,$catraca);
                
            /*foreach ($acesso as $i) {
                $catraca = Catraca::where('cred_numero',ltrim($i->carteirinha, '0'))
                ->whereBetween('mov_datahora',[$dateini,$datefim])
                ->orderBy('MOV_DATAHORA','desc')
                ->get();
                if(!$catraca){
                    $catraca = Catraca::where('PES_NUMERO',ltrim($i->RA, '0'))
                    ->whereBetween('mov_datahora',[$dateini,$datefim])
                    ->orderBy('MOV_DATAHORA','desc')
                    ->get();
                }
            }
            */
            //dd($catraca);
            return view('portal.catraca.index',compact('acesso','catraca'));                     
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
        
    }
}
