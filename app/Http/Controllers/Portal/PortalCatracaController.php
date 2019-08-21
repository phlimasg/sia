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
            $acesso = Totvs_alunos::select('carteirinha','RA')->where('RA',Auth::user()->name)->first();
            if(!$acesso){
                $acesso = Totvs_alunos::select('carteirinha','RA')
                ->whereRaw("REPLACE(respfincpf,'/','')='".Auth::user()->name."'")
                ->orWhereRaw("REPLACE(respacadcpf,'/','')='".Auth::user()->name."'")                
                ->first();
            }
            
            $dateini = date('d/m/Y', strtotime('-30 days'));
            $datefim = date('d/m/Y', strtotime('1 days'));
            
            $catraca = Catraca::where('cred_numero',ltrim($acesso->carteirinha, '0'))
            ->whereBetween('mov_datahora',[$dateini,$datefim])
            ->orderBy('MOV_DATAHORA','desc')
            ->get();
            if(!$catraca){
                $catraca = Catraca::where('PES_NUMERO',ltrim($acesso->RA, '0'))
                ->whereBetween('mov_datahora',[$dateini,$datefim])
                ->orderBy('MOV_DATAHORA','desc')
                ->get();
            }
            //dd($catraca);
            return view('portal.catraca.index',compact('catraca'));                     
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
        
    }
}
