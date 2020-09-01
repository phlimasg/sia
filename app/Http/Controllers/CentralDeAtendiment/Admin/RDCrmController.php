<?php

namespace App\Http\Controllers\CentralDeAtendiment\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Google_Client;
use Google_Service_Gmail;
use Google_Service_Oauth2;


class RDCrmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $gmail = new Google_Service_Gmail($client);            
            
            dd($gmail->users_messages->listUsersMessages('raphael.oliveira@lasalle.org.br'));
            
            //return redirect()->route('communicated.index');
            
            
        } catch (\Exception $e) {
            return view('errors.error', compact('e'));
        }           
        
    }
    
}
