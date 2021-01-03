@extends('layouts.app')

@section('js')
    onload="imprimir()"
@endsection
   
@section('content')

<script>
        $(document).ready(function() {
            var coluna = $('#td').attr('value');
            console.log(coluna);
            if(coluna != 'true'  ){
                $('#divPrincipal').append('<div class="alert alert-danger" role="alert"><strong> Não foram encontrados prontuários</strong></div>');
            }
        });
        

</script>


<div class="container" id="divPrincipal">
<button class="btn btn-primary" onClick="imprimir()" id="btnImprime"><i class="fas fa-print"></i> Imprimir</button>
<br>
<br>
    <table class="table" >
        <thead class="table-dark">
            <tr>
                <th><i class="fas fa-id-card"></i> CNS</th>
                <th><i class="fas fa-user"></i> Nome Completo</th>
                <th><i class="fas fa-sort-numeric-up"></i> Nº Estante</th>
                <th><i class="fas fa-font"></i> Letra</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prontuarios as $p)
            <tr>
                <td id="td" value="true"><strong style="font-size:20px">{{$p->getCns()}}</strong></td>
                <td><strong style="font-size:18px">{{$p->getNomecompleto()}}</strong></td>
                <td><strong style="font-size:20px">{{$p->getEstante()}}</strong></td>
                <td><strong style="font-size:20px">{{$p->getLetra()}}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
        /*function imprimir(){
            var conteudo = document.getElementById('divPrincipal').innerHTML,
            //tela_impressao = window.open('about:blank');
            tela_impressao = window.open('about:blank');
            tela_impressao.document.write(conteudo);
            tela_impressao.window.print();
            tela_impressao.window.close();
        }
        */
       $(function(){
          $("#btnImprime").click(function(){
            $("#btnImprime").hide();
            window.print();
            $("#btnImprime").show();
          }); 
       });
       
    </script>
@endsection