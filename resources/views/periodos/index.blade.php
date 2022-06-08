@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Periodos</h1>
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
            <a class="btn btn-primary" href="{{route('periodos.create')}}"><i class="fas fa-plus-circle"></i> Agregar Periodo</a>
        </div>
        <div>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th class="text-center">Grados</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($periodos as $periodo)
                    <tr>
                        <td>{{$periodo->id}}</td>
                        <td>{{$periodo->name}}</td>
                        <td class="text-center"><a href="{{route('grados.show',$periodo->id)}}">{{$periodo->grados->count()}}</a></td>
                        <td>
                            
                            <form action="{{route('periodos.destroy',$periodo->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-success" href="{{route('grado.creargrado',$periodo->id)}}" ><i class="fas fa-book"></i></a>
                                <a class="btn btn-success" href="{{route('periodos.edit',$periodo->id)}}" ><i class="fas fa-edit"></i></a>
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                            
                        </td>
                    </tr>  
                    @endforeach
                </tbody>
            </table>
        </div>
   </div>
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