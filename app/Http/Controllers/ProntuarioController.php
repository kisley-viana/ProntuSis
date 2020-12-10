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

    //Listagem de Prontuarios
    public function listar()
    {
        $prontuarios = Prontuario::orderBy('nomecompleto','asc')->get();
        
        return view('paginas.admin',['prontuarios'=>$prontuarios]);
    }

    //Salvar Dados
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
            //$msg='<div class='.'"alert alert-success"'. 'role="alert"'.'"Prontuario salvo com sucesso!"'.'<div>';
            
            session()->flash('sucesso','Prontuario salvo com sucesso');
            return redirect()->route('admin');
            
        }
        catch(\Exception $ex)
        {
            session()->flash('erro','Houve um erro ao salvar o Prontuario. Reveja os dados e tente novamente!');
            return redirect()->route('admin');
            //return dd($ex);
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

    //Pesquisa
    public function pesquisa(Request $request)
    {
        try
        {
                $pesquisa = ($request->id_pesquisa);
                $prontuarios = Prontuario::where('id',$pesquisa)
                ->orderBy('nomecompleto','asc')->get();

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

    //Filtro
    public function filtro(Request $request)
    {
        try
        {
            $letra = $request->letra.'%';
            $prontuarios = Prontuario::where('nomecompleto','like',$letra)
            ->orderBy('nomecompleto','asc')->get();
            return view('paginas.admin',['prontuarios'=>$prontuarios]);
        }
        catch(\Exception $ex)
        {
            //session()->flash('erro','E');
           // return redirect()->route('admin');
           return dd($ex);
        }
    }
}
