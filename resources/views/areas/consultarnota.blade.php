@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Boleta de Notas</h1>
@stop

@section('content')
<div class="flex d-flex">
<a class="btn btn-danger m-2" href="{{route('area.consultarnotapdf',[$area->id,$user->id])}}" role="button">Generar PDF</a><br><br>
<a class="btn btn-info m-2" href="{{route('area.consultar',[$area->grado->id,$user->id])}}" role="button">Regresar</a><br><br>
</div>
<table class="table">
    <thead class="table table-dark">
        <tr>
            <th>Calificcación</th>
            <th>Notas</th>
        </tr>
    </thead>
    <tbody>
@foreach (json_decode($consulta)->tables as $table2)
@foreach ($table2->tabledata as $table)
@isset($table->leader)
<h2>{!!($table->itemname->content)!!} - {{$table2->userfullname}}</h2>
<hr>
@endisset   

@isset($table->grade)
<tr>
    <td>{!!($table->itemname->content)!!}</td>
    <td>{{$table->grade->content}}</td>
@endisset   
</tr>
</tbody>
@endforeach
@endforeach
</table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop