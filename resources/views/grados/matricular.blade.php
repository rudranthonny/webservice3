@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{$grado->periodo->name}} - {{$grado->name}} - Matriculaciones</h1>
@stop

@section('content')
    <div class="mb-3">
        <a class="btn btn-info" href="{{route('grados.show',$grado->periodo->id)}}"><i class="fas fa-back"></i> Regresar</a>
    </div>
   <div class="container">
    @if ($users->count() > 0)
    <form action="{{route('grado.matricular',$grado->id)}}" method="POST">
            @csrf
              <div class="mb-3">
                <label for="user_id" class="form-label">Elegir Usuario</label>
                <select class="form-control" name='user_id'>
                    @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name." ".$user->ap_paterno." ".$user->ap_materno}}</option>
                    @endforeach
                </select>  
              </div>
              <div class="mb-3">
                <button class="btn btn-success">Matricular Estudiante</button>
                <a class="btn btn-info" href="{{route('grados.show',$grado->periodo->id)}}">Regresar</a>
              </div>
              <hr>
        </form>
        @endif  
        <div>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                    <th>Nombres y Apellidos</th>
                    <th>Email</th>
                    <th>DNI</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($grado->users as $user)
                    <tr>
                        <td>{{$user->name." ".$user->ap_paterno." ".$user->ap_materno}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->dni}}</td>
                        <td>
                            <a href="{{route('area.consultar',[$grado->id,$user->id])}}" class="btn btn-success"><i class="fas fa-atlas"></i></a>
                            <a href="{{route('grado.desmatricular',[$grado->id,$user->id])}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script>
        function eliminar(a){
         document.getElementById(a).submit()
        }
    </script>
@stop