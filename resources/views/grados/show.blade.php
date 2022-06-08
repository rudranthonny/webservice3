@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{$periodo->name}}</h1>
@stop

@section('content')

<div class="container">
    <div class="mb-3">
        <a class="btn btn-info" href="{{route('periodos.index')}}"><i class="fas fa-back"></i> Regresar</a>
    </div>
    <!--info-->    
     @if (session('info'))
     <div class="mb-3 alert alert-success alert-dismissible fade show" role="alert">
         <strong>{{session('info')}}</strong>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
     @endif
     <!--tabla-->
     <div>
         <table class="table">
             <thead class="table-dark">
                 <tr>
                 <th>Grados</th>
                 <th>Estudiantes</th>
                 <th>Acciones</th>
                </tr>
             </thead>
             <tbody class="bg-white">
                 @foreach ($periodo->grados as $grado)
                 <tr>
                     <td>{{$grado->name}}</td>
                     <td>{{$grado->users->count()}}</td>
                     <td><a href="{{route('grado.consultar',$grado->id)}}" class="btn btn-success">Matricular</a></td>
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