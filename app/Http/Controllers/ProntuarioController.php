<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prontuario;

class ProntuarioController extends Controller
{
    public function listar()
    {
        $prontuarios = Prontuario::all();
        //$msg='Prontuario salvo com sucesso!';
        $msg='e';
        return view('paginas.admin',['prontuarios'=>$prontuarios])->with('msg',$msg);
    }
    public function salvar(Request $request)
    {
        try
        {
            $prontuarios = Prontuario::findOrNew($request->id);
            
            //$prontuarios->setCns($request->cns);
            $prontuarios->setId($request->id);
            $prontuarios->setNomecompleto($request->nomecompleto);
            $prontuarios->setSexo($request->sexo);
            $prontuarios->setEstante($request->estante);
            $prontuarios->setLetra($request->letra);
            $prontuarios->setArmazenado($request->armazenado);
            $prontuarios->save();
        }
        catch(\Exception $ex)
        {
            return dd($ex);
        }
    }

    //Deletar
    public function deletar(Request $request)
    {
        try
        {
            $prontuario = Prontuario::find($request->id_excluir);
            $prontuario->delete();

            return redirect()->route('admin');
        }
        catch(\Exception $ex)
        {
            return dd($ex);
        }
    }
}
