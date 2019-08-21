<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Totvs_alunos;
use Illuminate\Support\Facades\Auth;
use App\User as AppUser;
use App\Model\Profile;

class PortalLoginController extends Controller
{
    public function index()
    {
        return view('portal.login.login');
    }
    public function auth(Request $request)
    {
        $request->validate([
            'usuario'=>'numeric|required',
            'senha'=>'numeric|required'
        ],[
            'numeric' => 'Só são permitidos números.',
            'required' => 'Todos os campos são obrigatórios.',
        ]);
        //usuario 00097769584
        //senha 24101980
        try {
            $totvsacad = Totvs_alunos::whereRaw("REPLACE(REPLACE(respacadcpf,'.',''),'-','') = '".$request->usuario."'")
            ->whereRaw("REPLACE(respacaddtnascimento,'/','')='".$request->senha."'")
            ->selectRaw('respacadcpf, respacademail as email')
            ->first();
            if(is_null($totvsacad->email)){
                echo "<script>alert('O usuário não possui email cadastrado no Totvs. Entre em contato com a secretaria.')</script>";
                return redirect()->back()->withErrors(['O usuário não possui email cadastrado no Totvs. Entre em contato com a secretaria.']);                    
            }
            if($totvsacad){
                $this->loginPortal($request,$totvsacad);
            }else {
                $totvsfin = Totvs_alunos::whereRaw("REPLACE(REPLACE(respfincpf,'.',''),'-','') = '".$request->usuario."'")
                ->whereRaw("REPLACE(respfindtnascimento,'/','')='".$request->senha."'")
                ->selectRaw('respfincpf, respfinemail as email')
                ->first();
                if(is_null($totvsfin->email)){
                    echo "<script>alert('O usuário não possui email cadastrado no Totvs. Entre em contato com a secretaria.')</script>";
                    return redirect()->back()->withErrors(['O usuário não possui email cadastrado no Totvs. Entre em contato com a secretaria.']);                    
                }
                if($totvsfin){
                    $this->loginPortal($request,$totvsfin);
                }
                else {
                    return redirect()->back()->withErrors(['Usuário não encontrado!']);
                }
            }            
            return redirect()->route('communicated.index');
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
        
    }
    public function loginPortal(Request $request,$totvs)
    {
        try {
            $user = AppUser::where('name',$request->usuario)->first();
            if($user){
                Auth::loginUsingId($user->id);
            }else{
                $user = AppUser::create([
                    'name' =>$request->usuario,
                    'email' =>$totvs->email,
                    'password' => null,
                ]);
                Profile::create([
                    'name'=>'portal',
                    'user_id' => $user->id,
                ]);
                Auth::loginUsingId($user->id);
            }            
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
    }
}

