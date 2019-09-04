<?php

namespace App\Http\Controllers\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\senderror;
use App\Model\error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function senderror(Request $request)
    {
        $error = new error();
        $error->name = $request->name;
        $error->email = $request->email;
        $error->tel = $request->tel;
        $error->url = $request->url;
        $error->error = $request->error;
        $error->save();
        Mail::to('raphael.oliveira@lasalle.org.br')->send(new senderror($request));
        Auth::logout();             
        return redirect()->route('portal.index');
    }
}
