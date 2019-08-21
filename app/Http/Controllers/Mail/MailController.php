<?php

namespace App\Http\Controllers\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\senderror;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function senderror(Request $request)
    {
        Mail::to('raphael.oliveira@lasalle.org.br')->send(new senderror($request));
    }
}
