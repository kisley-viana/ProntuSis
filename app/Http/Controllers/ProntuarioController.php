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
        $msg='';
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
            //$msg='<div class='.'"alert alert-success"'. 'role="alert"'.'"Prontuario salvo com sucesso!"'.'<div>';
            //
            $msg="cadastrado com sucesso";
            return redirect()->route('admin',['prontuarios'=>$prontuarios, 'msg',$msg]);
            
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
        {   $prontuarios = Prontuario::all();
            $prontuario = Prontuario::find($request->id_excluir);
            $prontuario->delete();
            $msg="Excluído com sucesso!";
            //return view('paginas.admin',['prontuarios'=>$prontuarios])->with('msg', $msg);
            return redirect()->action('ProntuarioController@listar')->with('msg',$msg);
        }
        catch(\Exception $ex)
        {
            return ($ex);
        }
    }

    public function pesquisa(Request $request)
    {
        //$prontuarios = Prontuario::all();
        $pesquisa = ($request->id_pesquisa);
        $prontuarios = Prontuario::where('id',$pesquisa)->get();

            return view('paginas.admin',['prontuarios'=> $prontuarios]);

    }
}
