<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Google_Client;
use Google_Service_Oauth2;
use App\Model\Totvs_alunos;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Model\Profile;
use Google_Service_Gmail;

class GoogleLoginController extends Controller
{
    public function login()
    {
        try {
            $clientID = env('GOOGLE_CLIENT_ID');
            $clientSecret = env('GOOGLE_CLIENT_SECRET');
            $redirectUri = route('gLogin');        
            // create Client Request to access Google API
            $client = new Google_Client();
            $client->setApplicationName('Sistema Integrado Abel - SIA');
            //$client->setScopes(Google_Service_Oauth2::USERINFO_PROFILE);
            //$client->setScopes(Google_Service_Gmail::GMAIL_READONLY);
            $client->setClientId($clientID);
            $client->setClientSecret($clientSecret);
            $client->setRedirectUri($redirectUri);
            $client->addScope("email");
            $client->addScope("profile");
            
            // authenticate code from Google OAuth Flow
            if (isset($_GET['code'])) {
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                $client->setAccessToken($token['access_token']);
                
                // get profile info
                $google_oauth = new Google_Service_Oauth2($client);
                $this->checarLogin($google_oauth);
                return redirect()->route('communicated.index');
            
            // now you can use this profile info to create account in your website and make user logged in.
            } else {
                return redirect($client->createAuthUrl());
            }            
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }
    }

   public function checarLogin(Google_Service_Oauth2 $client){
    try {
        $google = $client->userinfo->get();
        if($google->hd == 'soulasalle.com.br'){
            $totvs = Totvs_alunos::select('RA','NOME_ALUNO')->where('nome_aluno',$google->name)->first();
            //dd($totvs->RA);
            if ($totvs) {
                $user = User::where('email', $google->email)->first();
                if ($user) {
                    Auth::loginUsingId($user->id);
                } else {
                    $new_user = User::create([
                        'name' => $totvs->RA,
                        'email' => $google->email,                    
                    ]);
                    Profile::create([
                        'name' => 'portal',
                        'user_id' => $new_user->id
                    ]);
                    Auth::loginUsingId($new_user->id);
                }
                
            }
            else{
                return redirect()->route('portal.index')->withErrors(['Usuário não encontrado!']);
            }
        }
        elseif($google->hd == 'lasalle.org.br'){
            $user = User::where('email',$google->email)->first();
            //dd($google);
            
            if($user){
                           
                Auth::loginUsingId($user->id);
            }
            else {
                $new_user = User::create([
                    'name' => $google->name,
                    'email' => $google->email,                    
                    ]);
                    Profile::create([
                        'name' => 'portal',
                        'user_id' => $new_user->id
                        ]);
                    Auth::loginUsingId($new_user->id);
                    }
                }      
    } catch (\Exception $e) {
        return view('errors.error', compact('e'));
    }

   }
}
