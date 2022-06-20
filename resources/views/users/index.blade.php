@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Usuarios</h1>
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
            <a class="btn btn-primary" href="{{route('users.create')}}"><i class="fas fa-plus-circle"></i> Agregar Estudiante</a>
            <a class="btn btn-secondary" target="_blank" href="{{route('user.ingresar_moodle')}}"><i class="fas fa-plus-circle"></i>Ingresar a Moodle</a>
        </div>
        <div>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                    <th>Nombres y Apellidos</th>
                    <th class="text-center">dni</th>
                    <th class="text-center">Celular</th>
                    <th class="text-center">Email</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->name." ".$user->ap_paterno." ".$user->ap_materno}}</td>
                        <td>{{$user->celular}}</td>
                        <td>{{$user->dni}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <form action="{{route('users.destroy',$user->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                @if ($user->estado==0)
                                <a class="btn btn-success" href="{{route('user.suspender',$user->id)}}" ><i class="fas fa-eye"></i></a>
                                @else
                                <a class="btn btn-secondary" href="{{route('user.suspender',$user->id)}}" ><i class="fas fa-eye-slash"></i></a>
                                @endif
                                <a class="btn btn-success" href="{{route('users.edit',$user->id)}}" ><i class="fas fa-edit"></i></a>
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
