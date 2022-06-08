@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{$periodo->name}} - Crear Grado</h1>
@stop

@section('content')
   <div class="container">
        <form action="{{route('grado.store2',$periodo->id)}}" method="POST">
            @csrf
              <div class="mb-3">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre del Grado</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="nombre del curso">
              </div>
              <div class="mb-3">
                <label for="plantilla_id" class="form-label">Elegir Plantilla</label>
                <select class="form-control" name='plantilla_id'>
                    @foreach ($plantillas as $plantilla)
                    @if ($plantilla->cursos->count() > 0)
                    <option value="{{$plantilla->id}}">{{$plantilla->name}}</option>
                    @endif
                    @endforeach
                </select>
              </div>
              <div class="mb-3">
                <button class="btn btn-success">Crear Grado</button>
                <a class="btn btn-info" href="{{route('periodos.index')}}">Regresar</a>
              </div>
              <hr>
        </form>
   </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script>
        function eliminar(a){
         document.getElementById(a).submit()
        }
    </script>
@stop