<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prontuario;

class ProntuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       // $this->middleware('guest')->except('logout');

    }
    

    //Listagem de Prontuarios
    public function listar()
    {
        try
        {
            $prontuarios = Prontuario::orderBy('nomecompleto','asc')->get();
        
            return view('paginas.admin',['prontuarios'=>$prontuarios]);
        }
        catch(\Exception $ex)
        {
            session()->flash('erro', 'Erro ao listar dados. Contate o Programador');
            return redirect()->route('login');
        }
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
            session()->flash('erro','Houve um erro ao salvar o Prontuario. Reveja os dados e tente novamente! ou  Contate o Programador ');
            session()->flash('codErro','Erro: '.$ex);
            return redirect()->route('admin');
            //return dd($ex);
        }
    }
    //Verificador de CNS
    public function verificaCns(Request $request)
    {
        $cns = $request->cns;
        $verifica = Prontuario::where('cns',$cns)->get();
        if($verifica->num_rows > 0)
        {
          echo '<strong style="color: red">CNS já existente</strong>';
        }
        else
        {
          echo '<strong style="color: green">Cns disponível para cadastro</strong>';
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
            session()->flash('erro','Erro ao deletar Prontuario. Contate o Programador');
            session()->flash('codErro','Erro: '.$ex);
            return redirect()->route('admin');
        }
    }

    //Pesquisa
    public function pesquisa(Request $request)
    {
        try
        {
                $pesquisa = $request->pesquisa;
                if(is_numeric ($pesquisa))
                {
                    $prontuarios = Prontuario::where('cns',$pesquisa)
                    ->orderBy('cns','asc')->get();
                    return view('paginas.admin',['prontuarios'=> $prontuarios]);
                }
                if(is_string($pesquisa))
                {
                    $pesquisa = $pesquisa.'%';
                    $prontuarios = Prontuario::where('nomecompleto','like',$pesquisa)
                    ->orderBy('nomecompleto','asc')->get();
                    return view('paginas.admin',['prontuarios'=> $prontuarios]);
                }
             
        }
        catch(\Exception $ex)
        {
            session()->flash('erro','Erro na pesquisa. Contate o Programador');
            session()->flash('codErro','Erro: '.$ex);
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
            session()->flash('erro','Erro ao realizar filtragem. Contate o Programador.');
            session()->flash('codErro','Erro: '.$ex);
           return dd($ex);
        }
    }

    //Página de imprimir
    public function imprime(Request $request)
    {
        try
        {
            $letra = $request->letra.'%';
            $prontuarios = Prontuario::where('nomecompleto','like',$letra)
            ->orderBy('nomecompleto','asc')->get();
            return view('paginas.imprime',['prontuarios'=>$prontuarios]);
        }
        catch(\Exception $ex)
        {
            session()->flash('Erro ao imprimir. Contate o Programador.');
            session()->flash('codErro','Erro: '.$ex);
            return redirect()->route('admin'); 
        }
    }

    //Página de imprimir todos
    public function imprimeTodos()
    {
        try
        {
            $prontuarios = Prontuario::orderBy('nomecompleto','asc')->get();
            return view('paginas.imprime',['prontuarios'=>$prontuarios]);
        }
        catch(\Exception $ex)
        {
            session()->flash('erro','Erro ao imprimir todos. Contante o Programador.');
            session()->flash('codErro','Erro: '.$ex);
            return redirect()->route('admin');
        }
    }
}
