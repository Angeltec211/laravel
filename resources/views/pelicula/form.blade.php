<h1> {{ $modo }} pelicula </h1>

@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
    
<ul>
@foreach ($errors->all() as $errors)
<li>{{$errors}}</li>
@endforeach

@endif</ul></div>



<div class="form-group">

<label for="Nombre">Nombre</label>
<input type="text" class="form-control" name="nombre" value="{{ isset ($pelicula->nombre)?$pelicula->nombre:old('nombre') }}" id="nombre">
<br></div>

<div class="form-group">
<label for="Porter"> </label>
@if(isset($pelicula->poster))
<img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$pelicula->poster }}" width="100" alt="">
@endif
<input type="file"  class="form-control" name="poster" value=""  id="poster"><br>
</div>

<div class="form-group">
<label for="Duracion">Duración</label>
<input type="text"  class="form-control" name="duracion" value="{{ isset ($pelicula->duracion)?$pelicula->duracion:old('duracion') }}"  id="duracion"><br>
</div>

<div class="form-group">
<label for="Clasificacion">Clasificación</label>
<input type="text"  class="form-control" name="clasificacion" value="{{ isset ($pelicula->clasificacion)?$pelicula->clasificacion:old('clasificacion') }}"  id="clasificacion">
<br>
</div>

<input class="btn btn-success" type="submit" value="{{ $modo }} datos">

<a class="btn btn-primary" href="{{ url('pelicula/') }}"> Regresar </a>

<br>
