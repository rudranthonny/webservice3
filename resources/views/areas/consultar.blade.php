@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{$user->name."-".$user->ap_paterno."-".$user->ap_materno}}</h1>
@stop

@section('content')

<div class="container">
    <div class="mb-3">
        <a class="btn btn-info" href="{{route('grado.consultar',$grado->id)}}"><i class="fas fa-back"></i> Regresar</a>
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
                 <th>Nombre del Curso</th>
                 <th>Promedio Final</th>
                 <th>Acciones</th>
                </tr>
             </thead>
             <tbody class="bg-white">
                 @foreach ($grado->areas as $area)
                 <tr>
                     <td>{{$area->name}}</td>
                     <td>{{$l_notas[$area->id]}}</td>
                     <td><a href="{{route('area.consultarnota',[$area->id,$user->id])}}" class="btn btn-success">Ver Notas</a>  <a href="{{route('area.reiniciar',$area->id)}}" class="btn btn-danger">Reiniciar</a></td>
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