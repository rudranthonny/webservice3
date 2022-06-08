@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{$plantilla->name}} - Crear Cursos</h1>
@stop

@section('content')
   <div class="container">
        <form action="{{route('curso.store2',$plantilla->id)}}" method="POST">
            @csrf
              <div class="mb-3">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre del Curso</label>
                <input type="hidden" name="plantilla_id" value="{{$plantilla->id}}">
                <input type="text" class="form-control" name="name" id="name" placeholder="nombre del curso">
              </div>
              <div class="mb-3">
                <button class="btn btn-success">Crear Curso</button>
                <a class="btn btn-info" href="{{route('plantillas.index')}}">Regresar</a>
              </div>
              <hr>
        </form>
   </div>
   @if ($plantilla->cursos->count() > 0)
    <table class="table">
        <thead class="table-dark">
            <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($plantilla->cursos as $curso)
            <tr>
                <td>{{$curso->name}}</td>
                <td>
                    <a class="btn btn-danger" id="eliminarestudiante" href="#"
                    onclick="eliminar('eliminar-{{$curso->id}}')"><i class="fas fa-trash"></i></a>
                    <form action="{{route('curso.destroy2',[$curso->id,$plantilla->id])}}" method="POST" id="eliminar-{{ $curso->id }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>  
            @endforeach
        </tbody>
    </table>
   @endif
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