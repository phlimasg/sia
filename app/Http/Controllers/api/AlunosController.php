<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Model\AlunosGv;
use Illuminate\Http\Request;

class AlunosController extends Controller
{
    public function insert_alunos(Request $request)
    {
       // dd($request->json()->all());
        foreach ($request->json()->all() as $i) {
            dd($i['RA']);
        }
        dd($request->json(['alunos']));
        try {            
            $aluno = AlunosGv::find($request->RA);
            if($aluno){
                $aluno->update($request->all());
            }
            else{
                AlunosGv::create($request->all());
            }
            return 200;
        } catch (\Exception $e) {
            return 300 ." \n". $e->getMessage() . "\n" . $request->RA;
        }
    } 
}
