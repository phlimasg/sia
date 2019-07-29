<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailTeste;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function mail()
    {
        try {
            $horaini= date('H:i:s');  
            for ($i=0; $i < 9; $i++) { 
                # code...
                Mail::to('raphael.oliveira@lasalle.org.br')
                ->queue(new EmailTeste());            
            }          
            $horafim = date('H:i:s');
            return 'Envio de mail |'.$horaini.' - '.$horafim;
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
