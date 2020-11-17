@extends('layouts.app')
@section('content')
@if(session('sucesso'))

    <div class="alert alert-success" role="alert" id="msg">
        {{ session('sucesso') }}
    </div>
    
@endif
@if(session('erro'))
    <div class="alert alert-danger" role="alert" id="msg">
        {{ session('erro') }}
    </div>

@endif


<script>
    var mensagem = getElemetById("msg");
    mensagem.setTimeOut(3000);
</script>


<div class="container">

    <h1><strong>PRONTUARIOS</strong></h1>

    <form class="form-inline" action="{{route('pesquisa')}}" method="GET">
        <div class="form-group mx-sm-1 mb-2">
            <input type="text" class="form-control" placeholder="Digite o CNS" style="width: 20rem" name="id_pesquisa">
        </div>
        <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-search"></i> Pesquisar</button>
    </form>
    <table class="table" id="tbProntuario">
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
            <tr id="id_{{$p->getId()}}">
                <th scope="row" id="cns_{{$p->getId()}}">{{$p->getId()}}</th>
                    <td id="nome_{{$p->getId()}}">{{$p->getNomecompleto()}}</td>
                    <td>
                        @if($p->getArmazenado() == 1)
                            <img src="/img/check.svg" alt="armazenado" width="35px">
                        @endif
                        @if($p->getArmazenado() == 0)
                            <img src="/img/negative.svg" alt="armazenado" width="35px">
                        @endif
                    </td>
                    <td>
                    <!-- Botão Vizualizar -->
                        <button type="button" class="btn" data-toggle="modal" data-target="#prontuarioModalVer_{{$p->getId()}}"><img src="/img/view.svg" alt="vizualizar" width="27px"></button>
                            <div class="modal fade" id="prontuarioModalVer_{{$p->getId()}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="prontuarioModalLabel"><i class="fas fa-file-archive"></i> Prontuário</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <!--<input type="hidden" value="" name="id"> -->
                                            <label for="cns"><i class="fas fa-id-card"></i> CNS:</label>
                                            <h3 id="cns" style="color: blue">{{$p->getId()}}</h3>
                                            <label for="nomecompleto"><i class="fas fa-user"></i> Nome Completo:</label>
                                            <h3 id="nomecompleto" style="color: black">{{$p->getNomecompleto()}}</h3>
                                            <label for="sexo"><i class="fas fa-genderless"></i> Sexo:</label>
                                            @if($p->getSexo()== 'M')
                                            <h3 id="sexo" style="color: blue">Masculino</h3>
                                            @endif
                                            @if($p->getSexo()== 'F')
                                            <h3 id="sexo" style="color: purple">Feminino</h3>
                                            @endif
                                            <label for="estante"><i class="fas fa-sort-numeric-up"></i> Nº Estante:</label>
                                            <h3 id="estante" style="color: blue">{{$p->getEstante()}}</h3>
                                            <label for="letra"><i class="fas fa-font"></i> Letra:</label>
                                            <h3 id="letra" style="color: blue">{{$p->getLetra()}}</h3>
                                            <label for="armazenado"><i class="fas fa-archive"></i> Armazenado?:</label>
                                            @if($p->getArmazenado() == 1)
                                            <h3 id="armazenado" style="color: green">Sim</h3>
                                            @endif
                                            @if($p->getArmazenado() == 0)
                                            <h3 id="armazenado" style="color: red">Não</h3>
                                            @endif
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            </div>
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>
                    <!-- Fim Botão Vizualizar -->

                        <button type="button" class="btn" data-toggle="modal" data-target="#prontuarioModal_{{$p->getId()}}"><img src="/img/edit.svg" alt="editar" width="27px"></button>
                            <div class="modal fade" id="prontuarioModal_{{$p->getId()}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="prontuarioModalLabel"><i class="fas fa-file-archive"></i> Editar Prontuário</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('salvar')}}" method="POST">  
                                    @csrf
                                        <!--<input type="hidden" value="" name="id"> -->
                                        <label for="cns"><i class="fas fa-id-card"></i> CNS:</label>
                                        <input id="cns" class="form-control" name="id" value="{{$p->getId()}}">
                                        <label for="nomecompleto"><i class="fas fa-user"></i> Nome Completo:</label>
                                        <input id="nomecompleto" class="form-control" name="nomecompleto" value="{{$p->getNomecompleto()}}">
                                        <label for="sexo"><i class="fas fa-genderless"></i> Sexo:</label>
                                        <select id="sexo" class="form-control" name="sexo" value="{{$p->getSexo()}}">
                                            <option>{{$p->getArmazenado()}}</option>
                                            <option value="M">Masculino</option>
                                            <option value="F">Feminino</option>
                                        </select>
                                        <label for="estante"><i class="fas fa-sort-numeric-up"></i> Nº Estante:</label>
                                        <input id="estante" class="form-control" name="estante" style="width: 100px" value="{{$p->getEstante()}}">
                                        <label for="letra"><i class="fas fa-font"></i> Letra:</label>
                                        <input id="letra" class="form-control" name="letra" style="width: 100px" value="{{$p->getLetra()}}">
                                        <label for="armazenado"><i class="fas fa-archive"></i> Armazenado?:</label>
                                        <label for="armazenado"> Armazenado?:</label>
                                        <select id="armazenado" class="form-control" name="armazenado" style="width: 100px">
                                            <option>{{$p->getArmazenado()}}</option>
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

                    <!-- Botão Deletar -->
                        <button type="button" class="btn" name="prontuarioDelete" prontuario="{{$p->getId()}}" data-toggle="modal" data-target="#mdlProntuarioDeletar_{{$p->getId()}}"><img src="/img/trash.svg" width="27px"/></button>
                            <div id="mdlProntuarioDeletar_{{$p->getId()}}" class="modal fade" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form method="POST" enctype="multipart/form-data" action="{{route('deletar')}}">
                                        @csrf
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Excluir Prontuario</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" id="id_prontuario_excluir" name="id_excluir" value="{{$p->getId()}}"/>
                                            <p>Tem certeza que deseja excluir este Prontuario?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Confimar</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    <!-- Fim Botão Deletar -->
                        
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
        <h2 class="modal-title" id="prontuarioModalLabel"><i class="fas fa-file-archive"></i> Cadastrar Prontuário</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('salvar')}}" method="POST">  
        @csrf
            <!--<input type="hidden" value="" name="id"> -->
            <label for="cns"><i class="fas fa-id-card"></i> CNS:</label>
            <input id="cns" class="form-control" name="id">
            <label for="nomecompleto"><i class="fas fa-user"></i> Nome Completo:</label>
            <input id="nomecompleto" class="form-control" name="nomecompleto">
            <label for="sexo"><i class="fas fa-genderless"></i> Sexo:</label>
            <select id="sexo" class="form-control" name="sexo">
                <option>Selecione</option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
                <option value="S">Não definido</option>
            </select>
            <label for="estante"><i class="fas fa-sort-numeric-up"></i> Nº Estante:</label>
            <input id="estante" class="form-control" name="estante" style="width: 100px">
            <label for="letra"><i class="fas fa-font"></i> Letra:</label>
            <input id="letra" class="form-control" name="letra" style="width: 100px">
            <label for="armazenado"><i class="fas fa-archive"></i> Armazenado?:</label>
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

<!-- Modal Deletar 
<div id="mdlProntuarioDeletar" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{route('deletar')}}">
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir Prontuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_prontuario_excluir" name="id_excluir"/>
                    <p>Tem certeza que deseja excluir este Prontuario?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Confimar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
                </div>
            </form>
        </div>
</div>
-->
@endsection