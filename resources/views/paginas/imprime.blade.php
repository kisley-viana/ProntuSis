@extends('layouts.app')

@section('botoesEspeciais')
    <br><div class="container">
        <button class="btn btn-primary"><i class="fas fa-print"></i> Imprimir</button>
    </div>
@endsection
@section('content')
<div class="container" id="divPrincipal">
    <table class="table">
    <thead class="table-dark">
        <tr>
            <th>CNS</th>
            <th>Nome Completo</th>
            <th>Nº Estante</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>00</td>
            <td>00</td>
            <td>00</td>
        </tr>
    </tbody>
    </table>
</div>

@endsection