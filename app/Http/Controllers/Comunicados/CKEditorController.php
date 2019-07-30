<?php

namespace App\Http\Controllers\Comunicados;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {                                    
            //get filename with extension
            //dd($request->file('upload')->getSize());
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      dd(storage_path('uploads'));
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();
            $extensionAllow = array('pdf','jpg','jpeg','png','doc','docx','xls','xlsx','csv','mp4');
            if(in_array($extension,$extensionAllow) && $request->file('upload')->getSize() < 200000){
                $filenametostore = $filename.'_'.time().'.'.$extension;          
                //Upload File
                $request->file('upload')->storeAs('public/uploads', $filenametostore); 
                chmod(storage_path('app/public/uploads/').$filenametostore, 777);
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $url = asset('storage/uploads/'.$filenametostore); 
                $msg = 'Documento enviado com sucesso!'; 
                $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";                 
                // Render HTML output 
                @header('Content-type: text/html; charset=utf-8'); 
                echo $re;
            }    else {
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $url = '';
                $msg = 'Erro ao enviar! Verifique o tipo do arquivo e o tamanho maximo de '.ini_get('post_max_size'); 
                $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";                 
                // Render HTML output 
                @header('Content-type: text/html; charset=utf-8'); 
                echo $re;
            }        
      
            //filename to store
        }
    }
}
