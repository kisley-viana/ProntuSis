<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prontuario;

class ProntuarioController extends Controller
{
    public function listar()
    {
        $prontuarios = Prontuario::all();
        $msg="";
        return view('paginas.admin',['prontuarios'=>$prontuarios])->with('msg',$msg);
    }
    public function salvar(Request $request)
    {
        try
        {
            $prontuarios = Prontuario::findOrNew($request->id);
            
            $prontuarios->setCns($request->cns);
            $prontuarios->setNomecompleto($request->nomecompleto);
            $prontuarios->setSexo($request->sexo);
            $prontuarios->setEstante($request->estante);
            $prontuarios->setLetra($request->letra);
            $prontuarios->setArmazenado($request->armazenado);
            $prontuarios->save();
            $msg="Prontuario salvo com sucesso!";
            return view('paginas.admin',['prontuarios'=>$prontuarios])->with("msg", $msg);
        }
        catch(\Exception $ex)
        {
            return dd($ex);
        }
    }
}
