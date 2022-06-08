@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Periodo</h1>
@stop

@section('content')
   <div class="container">
        <form action="{{route('periodos.update',$periodo->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nombre Periodo</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$periodo->name}}" placeholder="nombre del periodo">
              </div>
              <div class="mb-3">
                <button class="btn btn-success">Actualizar Periodo</button>
                <a class="btn btn-info" href="{{route('periodos.index')}}">Regresar</a>
              </div>
        </form>
   </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop