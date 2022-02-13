@extends('layouts.app')

@section('content')
<div class="container">


@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">

  {{Session::get('message')}}
</div>
@endif



<a href="{{ url('pelicula/create') }}" class="btn btn-success"> Registra Nueva Cartelera </a>
<br>
<br>

<table class="table table-secondary">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Poster</th>
            <th>Nombre</th>
            <th>Duración</th>
            <th>Clasificación</th>
            
            <th>Acciones</th>
        </tr>
    </thead>


    <tbody>

@foreach($pelicula as $pelicula);

        <tr>
            <td>{{$pelicula->id}}</td>

            <td>
            <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$pelicula->poster }}" width="100" alt="">

            </td>

            <td>{{$pelicula->nombre}}</td>
            <td>{{$pelicula->duracion}}</td>
            <td>{{$pelicula->clasificacion}}</td>
            
            <td>
                
            <a href="{{  url('/pelicula/'.$pelicula->id.'/edit')  }} " class="btn btn-warning">
             Editar
            </a>    
            |
                
            <form action="{{  url('/pelicula/'.$pelicula->id)  }}" class="d-inline" method="post">
            @csrf
            {{ method_field('DELETE') }}
            <input class="btn btn-danger" type="submit" onclick="return confirm('Desea Borrar la Informacion')"
            value="Borrar">

            </form>
            
            </td>
        </tr>

@endforeach

    </tbody>
</table>


</div>
@endsection