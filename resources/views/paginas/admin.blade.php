@extends('layouts.app')
@section('content')
@if($msg != null)
    <div class="alert alert-success" role="alert">
        {{$msg}}
    </div>
@endif
<div class="container">
    <h1><strong>PRONTUARIOS</strong></h1>
        
    <form class="form-inline">
        <div class="form-group mx-sm-1 mb-2">
            <input type="text" class="form-control" placeholder="Digite o CNS" style="width: 20rem" name="pesquisa">
        </div>
        <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-search"></i> Pesquisar</button>
    </form>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">CNS</th>
                <th scope="col">Nome Completo</th>
                <th scope="col">Armazenado</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($prontuarios as $p)
            <tr>
                <th scope="row">{{$p->getCns()}}</th>
                    <td>{{$p->getNomecompleto()}}</td>
                    <td>
                        @if($p->getArmazenado() == 1)
                            <img src="/img/check.svg" alt="armazenado" width="35px">
                        @endif
                        @if($p->getArmazenado() == 0)
                            <img src="/img/neagtive.svg" alt="armazenado" width="35px">
                        @endif
                    </td>
                    <td>
                        <a href=""><img src="/img/edit.svg" alt="editar" width="27px"></a>
                        <a href="">&nbsp;<img src="/img/trash.svg" alt="deletar" width="27px"></a>
                        <a href="">&nbsp;<img src="/img/view.svg" alt="vizualizar" width="27px"></a>
                    </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Cadastro -->
<div class="modal fade" id="prontuarioModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="prontuarioModalLabel">Cadastrar Prontuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('salvar')}}" method="POST">  
        @csrf
            <input type="hidden" value="" name="id">
            <label for="cns">CNS:</label>
            <input id="cns" class="form-control" name="cns">
            <label for="nomecompleto">Nome Completo:</label>
            <input id="nomecompleto" class="form-control" name="nomecompleto">
            <label for="sexo">Sexo:</label>
            <select id="sexo" class="form-control" name="sexo">
                <option>Selecione</option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
                <option value="S">Não definido</option>
            </select>
            <label for="estante">Nº Estante:</label>
            <input id="estante" class="form-control" name="estante" style="width: 100px">
            <label for="letra">Letra:</label>
            <input id="letra" class="form-control" name="letra" style="width: 100px">
            <label for="armazenado">Armazenado?:</label>
            <select id="armazenado" class="form-control" name="armazenado" style="width: 100px">
                <option>Selecione</option>
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

@endsection