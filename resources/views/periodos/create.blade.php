@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear de Periodo</h1>
@stop

@section('content')
   <div class="container">
        <form action="{{route('periodos.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre Periodo</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="nombre del periodo">
              </div>
              <div class="mb-3">
                <button class="btn btn-success">Crear Periodo</button>
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