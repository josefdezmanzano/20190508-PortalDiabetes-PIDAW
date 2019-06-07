@extends('layouts.app')

@section('content')

<section id="about" class="about-section text-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <p class="h1">Crear categoria</p>
       <form name="f1" action="{{route('category.store')}}" method="POST">
          <!-- CONTROLAMOS LOS ERRORES DEL VALIDATE STORE -->
          @csrf
          @if($errors->any)
          <div>

            <ul>
              @foreach($errors->all() as $el_error)
              <li class="alert alert-danger">{{$el_error}}</li>
              @endforeach
            </ul>

          </div>
          @endif

          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="exampleFormControlFile1">
          </div>

          <div class="form-group">
            <label for="color">Color</label>
            <input type="color"  name="color" class="form-control" id="exampleFormControlFile1">
          </div>

          <div class="form-group">
            <label for="etiqueta">Etiqueta</label>
            <input type="text" name="etiqueta" class="form-control" id="exampleFormControlFile1">
          </div>

          <div class="form-group">

            <input type="submit" name="btn_env" class="btn btn-success" id="exampleFormControlFile1" value="Crear">
            <a href="{{url()->previous()}}" class="btn btn-info">Volver</a>
          </div>

        </form>

      </div>
    </div>

  </div>
</section>
@endsection
