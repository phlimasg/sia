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
            'usuario' => 'numeric|required',
            'senha' => 'numeric|required'
        ], [
            'numeric' => 'Só são permitidos números.',
            'required' => 'Todos os campos são obrigatórios.',
        ]);
        //usuario 00097769584
        //senha 24101980
        try {
            $totvsacad = Totvs_alunos::whereRaw("REPLACE(REPLACE(respacadcpf,'.',''),'-','') = '" . $request->usuario . "'")
                ->whereRaw("REPLACE(respacaddtnascimento,'/','')='" . $request->senha . "'")
                ->selectRaw('respacadcpf, respacademail as email')
                ->first();
            if ($totvsacad && !empty($totvsacad->email)) {
                $this->loginPortal($request, $totvsacad);
            } elseif ($totvsacad && empty($totvsacad->email)) {
                return redirect()->back()->withErrors(['O usuário não possui email cadastrado no Totvs. Entre em contato com a secretaria.']);
            } 

            $totvsfin = Totvs_alunos::whereRaw("REPLACE(REPLACE(respfincpf,'.',''),'-','') = '" . $request->usuario . "'")
                ->whereRaw("REPLACE(respfindtnascimento,'/','')='" . $request->senha . "'")
                ->selectRaw('respfincpf, respfinemail as email')
                ->first();

            if ($totvsfin && !empty($totvsfin->email)) {
                $this->loginPortal($request, $totvsfin);
            } elseif ($totvsfin && empty($totvsfin->email)) {
                return redirect()->back()->withErrors(['O usuário não possui email cadastrado no Totvs. Entre em contato com a secretaria.']);
            } 

            $totvspai = Totvs_alunos::whereRaw("REPLACE(REPLACE(PaiCPF,'.',''),'-','') = '" . $request->usuario . "'")
                ->whereRaw("REPLACE(Convert(VarChar,PaiDtNasc,103),'/','')='" . $request->senha . "'")
                ->selectRaw('PaiCPF, respacademail as email')
                ->first();
            if ($totvspai && !empty($totvspai->email)) {
                $this->loginPortal($request, $totvspai);
            //    dd($totvspai);
            } elseif ($totvspai && empty($totvspai->email)) {
                return redirect()->back()->withErrors(['O usuário não possui email cadastrado no Totvs. Entre em contato com a secretaria.']);
            }
            if (empty($totvspai)) {
                return redirect()->back()->withErrors(['Usuário e senha não conferem.']);
            }
            return redirect()->route('communicated.index');
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
    }
    public function loginPortal(Request $request, $totvs)
    {
        try {
            $user = AppUser::where('name', $request->usuario)->first();
            if ($user) {
                Auth::loginUsingId($user->id);
            } else {
                $user = AppUser::create([
                    'name' => $request->usuario,
                    'email' => $totvs->email,
                    'password' => null,
                ]);
                Profile::create([
                    'name' => 'portal',
                    'user_id' => $user->id,
                ]);
                Auth::loginUsingId($user->id);
            }
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
    }
}
