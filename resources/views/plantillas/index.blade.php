@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Plantillas</h1>
@stop

@section('content')
   <div class="container">
       <!--info-->    
        @if (session('info'))
        <div class="mb-3 alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('info')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <!--tabla-->
        <div class="mb-3">
            <a class="btn btn-primary" href="{{route('plantillas.create')}}"><i class="fas fa-plus-circle"></i> Agregar Plantilla</a>
        </div>
        <div>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                    <th>Nombre</th>
                    <th class="text-center">Cursos</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($plantillas as $plantilla)
                    <tr>
                        <td>{{$plantilla->name}}</td>
                        <td class="text-center">{{$plantilla->cursos->count()}}</td>
                        <td>
                            
                            <form action="{{route('plantillas.destroy',$plantilla->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-success" href="{{route('curso.crearcurso',$plantilla->id)}}"><i class="fas fa-book"></i></a>
                                <a class="btn btn-success" href="{{route('plantillas.edit',$plantilla->id)}}" ><i class="fas fa-edit"></i></a>
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                            
                        </td>
                    </tr>  
                    @endforeach
                </tbody>
            </table>
        </div>
   </div>
    <!--listado -->
   @isset($m_plantilla)
   @if ($m_plantilla->cursos->count() > 0)
    <table class="table">
        <thead class="table-dark">
            <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($m_plantilla->cursos as $curso)
            <tr>
                <td>{{$curso->name}}</td>
                <td>
                    <a class="btn btn-danger" id="eliminarestudiante" href="#"
                    onclick="eliminar('eliminar-{{$curso->id}}')"><i class="fas fa-trash"></i></a>
                    <form action="{{route('curso.destroy2',[$curso->id,$m_plantilla->id])}}" method="POST" id="eliminar-{{ $curso->id }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>  
            @endforeach
        </tbody>
    </table>
   @endif
   @endisset
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
   
    @stop