@extends('layouts.app')
@section('js')
    onload="imprimir()";
@endsection

@section('botoesEspeciais')
    <br><div class="container">
        <button class="btn btn-primary" onclick="imprimir()"><i class="fas fa-print"></i> Imprimir</button>
    </div>
@endsection
@section('content')


<div class="container" id="divPrincipal">
    <table class="table" >
        <thead class="table-dark">
            <tr>
                <th><i class="fas fa-id-card"></i> CNS</th>
                <th><i class="fas fa-user"></i> Nome Completo</th>
                <th><i class="fas fa-sort-numeric-up"></i> Nº Estante</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prontuarios as $p)
            <tr>
                <td>{{$p->getCns()}}</td>
                <td>{{$p->getNomecompleto()}}</td>
                <td>{{$p->getEstante()}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
        function imprimir(){
            var conteudo = document.getElementById('divPrincipal').innerHTML,
            //tela_impressao = window.open('about:blank');
            tela_impressao = window.open('about:blank');
            tela_impressao.document.write(conteudo);
            tela_impressao.window.print();
            tela_impressao.window.close();
        }
    </script>
@endsection