@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear Usuario</h1>
@stop

@section('content')
   <div class="container">
        <form action="{{route('users.store')}}" method="POST">
            @csrf
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" id="name">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-3">
                        <label for="ap_paterno" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" name="ap_paterno" id="ap_paterno">
                        @error('ap_paterno')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-3">
                        <label for="ap_materno" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" name="ap_materno" id="ap_materno">
                        @error('ap_materno')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-3">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" class="form-control" name="celular" id="celular">
                        @error('celular')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-3">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" class="form-control" name="dni" id="dni">
                        @error('dni')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-6">
                        <label for="dni" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                <button class="btn btn-success">Crear Estudiante</button>
                <a class="btn btn-info" href="{{route('users.index')}}">Regresar</a>
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