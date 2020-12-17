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
    <div class="alert alert-danger" role="alert" id="codErro">
        {{ session('codErro') }}
    </div>

@endif

<div class="container" id="divPrincipal">

    <h1><strong>PRONTUARIOS</strong></h1>

    <!-- Pesquisa -->
    <form class="form-inline" action="{{route('pesquisa')}}" method="GET">
        <div class="form-group mx-sm-1 mb-2">
            <input type="text" class="form-control" placeholder="Digite o Nome ou CNS" style="width: 20rem" name="pesquisa">
        </div>
        <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-search"></i> Pesquisar</button>
    </form>

    <button class="btn" data-toggle="modal" data-target="#mdlFiltro" style="background-color: green; color: white"><i class="fas fa-filter"></i> Filtro</button>
    <!-- Botão Imprimir -->
    <!-- <button class="btn btn-primary" id="btnImprimir" onclick="imprimir()"><i class="fas fa-print"></i> Imprimir</button><br><br>
    -->
    <button class="btn btn-primary" data-toggle="modal" data-target="#mdlImprime"><i class="fas fa-print"></i> Imprimir</button>
    
    <!-- Mensagem de erro "Sem dados encontrados" -->
    <script>
        $(document).ready(function() {
            var coluna = $('#td').attr('value');
            console.log(coluna);
            if(coluna != 'true'  ){
                $('#divPrincipal').append('<div class="alert alert-danger" role="alert"><strong> Não foram encontrados prontuários</strong></div>');
            }
        });
    </script>
    <!-- Modal Imprimir -->
    <div id="mdlImprime" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="GET" enctype="multipart/form-data" action="{{route('imprime')}}">
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Imprimir por Letra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="letra">Escolha a letra:</label>
                    <select class="form-control" id="letra" name="letra">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                        <option value="H">H</option>
                        <option value="I">I</option>
                        <option value="J">J</option>
                        <option value="K">K</option>
                        <option value="L">L</option>
                        <option value="M">M</option>
                        <option value="N">N</option>
                        <option value="O">O</option>
                        <option value="P">P</option>
                        <option value="Q">Q</option>
                        <option value="R">R</option>
                        <option value="S">S</option>
                        <option value="T">T</option>
                        <option value="U">U</option>
                        <option value="V">V</option>
                        <option value="W">W</option>
                        <option value="X">X</option>
                        <option value="Y">Y</option>
                        <option value="Z">Z</option>

                    </select>
                    <br>
                    <a href="{{route('imprime.todos')}}"><strong><i class="fas fa-clipboard-list"></i> Imprimir todos cadastrados</strong></a>
                   
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="imprimir()"><i class="fas fa-check-square"></i> Confimar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
                </div>
            </form>
        </div>
    </div> 
    
    
    <!-- Modal Filtro -->
    <div id="mdlFiltro" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="GET" enctype="multipart/form-data" action="{{route('filtro')}}">
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filtro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="de">Escolha a letra de início:</label>
                    <select class="form-control" id="de" name="letra">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                        <option value="H">H</option>
                        <option value="I">I</option>
                        <option value="J">J</option>
                        <option value="K">K</option>
                        <option value="L">L</option>
                        <option value="M">M</option>
                        <option value="N">N</option>
                        <option value="O">O</option>
                        <option value="P">P</option>
                        <option value="Q">Q</option>
                        <option value="R">R</option>
                        <option value="S">S</option>
                        <option value="T">T</option>
                        <option value="U">U</option>
                        <option value="V">V</option>
                        <option value="W">W</option>
                        <option value="X">X</option>
                        <option value="Y">Y</option>
                        <option value="Z">Z</option>

                    </select>
                   
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check-square"></i> Confimar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
                </div>
            </form>
        </div>
    </div> 
<br>
<br>
    <div id="tabela">
    <!-- TABELA DE PRONTUARIOS -->
     <table class="table" id="tbProntuario">
        <thead class="thead-dark">
            <tr>
                <th scope="col"><i class="fas fa-id-card"></i> CNS</th>
                <th scope="col"><i class="fas fa-user"></i> Nome Completo</th>
                <th scope="col"><i class="fas fa-archive"></i> Armazenado</th>
                <th scope="col"><i class="fas fa-hand-sparkles"></i> Ações</th>
            </tr>
        </thead>
        <tbody>

        @foreach($prontuarios as $p)
            <tr>
                <th scope="row" id="cns_{{$p->getCns()}}">{{$p->getCns()}}</th>
                    <td id="td" value="true">{{$p->getNomecompleto()}}</td>
                    <td>
                        @if($p->getArmazenado() == 'Sim')
                            <img src="/img/check.svg" alt="armazenado" width="30px">
                        @endif
                        @if($p->getArmazenado() == 'Não')
                            <img src="/img/negative.svg" alt="armazenado" width="30px">
                        @endif
                    </td>
                    <td>
                    <!-- Botão Vizualizar -->
                        <button type="button" class="btn" data-toggle="modal" data-target="#prontuarioModalVer_{{$p->getId()}}"><img src="/img/view.svg" alt="vizualizar" width="23px"></button>
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
                                            <h3 id="cns" style="color: blue">{{$p->getCns()}}</h3>
                                            <label for="nomecompleto"><i class="fas fa-user"></i> Nome Completo:</label>
                                            <h3 id="nomecompleto" style="color: black">{{$p->getNomecompleto()}}</h3>
                                            <label for="sexo"><i class="fas fa-genderless"></i> Sexo:</label>
                                            @if($p->getSexo()== 'Masculino')
                                            <h3 id="sexo" style="color: blue">Masculino</h3>
                                            @endif
                                            @if($p->getSexo()== 'Feminino')
                                            <h3 id="sexo" style="color: purple">Feminino</h3>
                                            @endif
                                            <label for="estante"><i class="fas fa-sort-numeric-up"></i> Nº Estante:</label>
                                            <h3 id="estante" style="color: blue">{{$p->getEstante()}}</h3>
                                            <label for="letra"><i class="fas fa-font"></i> Letra:</label>
                                            <h3 id="letra" style="color: blue">{{$p->getLetra()}}</h3>
                                            <label for="armazenado"><i class="fas fa-archive"></i> Armazenado?:</label>
                                            @if($p->getArmazenado() == 'Sim')
                                            <h3 id="armazenado" style="color: green">Sim</h3>
                                            @endif
                                            @if($p->getArmazenado() == 'Não')
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
                    
                    <!-- Botão Editar -->
                        <button type="button" class="btn" data-toggle="modal" data-target="#prontuarioModal_{{$p->getId()}}"><img src="/img/edit.svg" alt="editar" width="23px"></button>
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
                                        <input type="hidden" value="{{$p->getId()}}" name="id">
                                        <label for="cns"><i class="fas fa-id-card"></i> CNS:</label>
                                        <input id="cns" class="form-control" name="cns" value="{{$p->getCns()}}">
                                        <label for="nomecompleto"><i class="fas fa-user"></i> Nome Completo:</label>
                                        <input id="nomecompleto" class="form-control" name="nomecompleto" value="{{$p->getNomecompleto()}}">
                                        <label for="sexo"><i class="fas fa-genderless"></i> Sexo:</label>
                                        <select id="sexo" class="form-control" name="sexo" value="{{$p->getSexo()}}">
                                            <option>{{$p->getSexo()}}</option>
                                            @if($p->getSexo() == 'Feminino')
                                                <option value="Masculino">Masculino</option>
                                            @endif
                                            @if($p->getSexo() == 'Masculino')
                                                <option value="Feminino">Feminino</option>
                                            @endif
                                        </select>
                                        <label for="estante"><i class="fas fa-sort-numeric-up"></i> Nº Estante:</label>
                                        <input id="estante" class="form-control" name="estante" style="width: 100px" value="{{$p->getEstante()}}">
                                        <label for="letra"><i class="fas fa-font"></i> Letra:</label>
                                        <input id="letra" class="form-control" name="letra" style="width: 100px" value="{{$p->getLetra()}}">
                                        <label for="armazenado"><i class="fas fa-archive"></i> Armazenado?:</label>
                                        <select id="armazenado" class="form-control" name="armazenado" style="width: 100px">
                                            <option>{{$p->getArmazenado()}}</option>
                                            @if($p->getArmazenado() == 'Não')
                                                <option value="Sim">Sim</option>
                                            @endif
                                            @if($p->getArmazenado() == 'Sim')
                                                <option value="Não">Não</option>
                                            @endif
                                        </select>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Salvar</button>
                                        </div>
                                    </form>
                                </div>
                                
                                </div>
                            </div>
                            </div>
                    <!-- Fim Botão Editar -->

                    <!-- Botão Deletar -->
                        <button type="button" class="btn" name="prontuarioDelete" prontuario="{{$p->getId()}}" data-toggle="modal" data-target="#mdlProntuarioDeletar_{{$p->getId()}}"><img src="/img/trash.svg" width="23px"/></button>
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
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger">Confimar</button>
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
            <input type="hidden" value="" name="id">
            <label for="Cns"><i class="fas fa-id-card"></i> CNS:</label>
            <input id="Cns" class="form-control" name="cns">
            <input type="button" name="verificar" id="verificar" value="verificar" />
            <div id="resultado"></div>
            
            <!-- Verificador de CNS -->
            
            
            <label for="nomecompleto"><i class="fas fa-user"></i> Nome Completo:</label>
            <input id="nomecompleto" class="form-control" name="nomecompleto">
            <label for="sexo"><i class="fas fa-genderless"></i> Sexo:</label>
            <select id="sexo" class="form-control" name="sexo">
                <option>Selecione</option>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
            </select>
            <label for="estante"><i class="fas fa-sort-numeric-up"></i> Nº Estante:</label>
            <input id="estante" class="form-control" name="estante" style="width: 100px">
            <label for="letra"><i class="fas fa-font"></i> Letra:</label>
            <input id="letra" class="form-control" name="letra" style="width: 100px">
            <label for="armazenado"><i class="fas fa-archive"></i> Armazenado?:</label>
            <select id="armazenado" class="form-control" name="armazenado" style="width: 100px">
                <option>Selecione</option>
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
            </select>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Salvar</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<script>
    $(function(){ // declaro o início do jquery
        $("input[name='verificar']").on('click', function(){//botão para disparar a ação
            var numCns = $("input[id='Cns']").val();
            console.log(numCns);
            $.get('admin/salvar/verificador?_token='+'{{csrf_token()}}&'+'numCns=' + numCns,function(data){
                //$('#resultado').html(data);//onde vou escrever o resultado
                alert(data);
            });
        });
    });// fim do jquery
</script>



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