<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prontuario;

class ProntuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function listar()
    {
        $prontuarios = Prontuario::all();
        
        return view('paginas.admin',['prontuarios'=>$prontuarios]);
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
            session()->flash('sucesso','Prontuario salvo com sucesso');
            return redirect()->route('admin');
            
        }
        catch(\Exception $ex)
        {
            session()->flash('erro','Houve um erro ao salvar o Prontuario. Reveja os dados e tente novamente!');
            return redirect()->route('admin');
        }
    }

    //Deletar
    public function deletar(Request $request)
    {
        try
        {   $prontuarios = Prontuario::all();
            $prontuario = Prontuario::find($request->id_excluir);
            $prontuario->delete();
            
            //return view('paginas.admin',['prontuarios'=>$prontuarios])->with('msg', $msg);
            session()->flash('sucesso','Prontuario deletado com sucesso!');
            return redirect()->route('admin');
        }
        catch(\Exception $ex)
        {   
            session()->flash('erro','Erro ao deletar Prontuario. Erro: ',$ex);
            return redirect()->route('admin');
        }
    }

    public function pesquisa(Request $request)
    {
        try
        {
                $pesquisa = ($request->id_pesquisa);
                $prontuarios = Prontuario::where('id',$pesquisa)->get();

                if($prontuarios != null){
                    session()->flash('sucesso', 'Prontuário(s) encontrados!');
                    return view('paginas.admin',['prontuarios'=> $prontuarios]);
                    
                }
        }
        catch(\Exception $ex)
        {
            session()->flash('erro','Erro na busca. Erro: '+$ex);
            return redirect()->route('admin');
        }
    }
}
