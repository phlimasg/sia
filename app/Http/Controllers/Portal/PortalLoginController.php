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
           
            if($totvsacad){
                $this->loginPortal($request,$totvsacad);
            }else {
                $totvsfin = Totvs_alunos::whereRaw("REPLACE(REPLACE(respfincpf,'.',''),'-','') = '".$request->usuario."'")
                ->whereRaw("REPLACE(respfindtnascimento,'/','')='".$request->senha."'")
                ->selectRaw('respfincpf, respfinemail as email')
                ->first();
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
            //dd($user->profile->id);
            if($user){
                Auth::loginUsingId($user->id);
            }else{
                //dd($request->usuario);
                $user = AppUser::create([
                    'name' =>$request->usuario,
                    'email' =>$totvs->email,
                    'password' => null,
                    //'profile_id' => 1,
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

