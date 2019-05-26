@extends('layouts.plantilla')

@section('content')

<section id="about" class="about-section text-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <p class="h1">Calculadora</p>
        <p>Recordamos que los niveles correctos de glucosa son antes de las comidas entre 85(mmg/dl) y 130(mmg/dl), 2H despues de las comidas entre 100(mmg/dl) y 180(mmg/dl), y la nocturna entre 90(mmg/dl) y 110(mmg/dl). </p>
        <form name="f1" action="{{route('medicion.store')}}" method="POST">
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
            <input type="hidden" name="user_id" value="{{$usuario}}">
          <label for="momento"> Momento del día </label>
            <select class="custom-select" name='momento' id="inputGroupSelect03">
              <option selected>Elige...</option>
              <option value="AD">ANTES DEL DESAYUNO</option>
              <option value="DD">2H DESPUES DEL DESAYUNO</option>
              <option value="AA">ANTES DE LA COMIDA</option>
              <option value="DA">2H DESPUES DE LA COMIDA</option>
              <option value="AC">ANTES DE LA CENA</option>
              <option value="DC">2H DESPUES DE LA CENA</option>
              <option value="N">NOCTURNA</option>
            </select>

          </div>

          <div class="form-group">
            <label for="glucose">Glucosa</label>
            <input type="number" name="glucose" class="form-control" id="exampleFormControlFile1">
          </div>

          <div class="form-group">
            <label for="rations">Raciones </label>
            <input type="number" step="0.1" name="rations" class="form-control" id="exampleFormControlFile1">
          </div>

          <div class="form-group">
            <label for="longActingInsulin">Insulina rapida</label>
            <input type="number" step="0.1" name="longActingInsulin" class="form-control" id="exampleFormControlFile1">
          </div>

          <div class="form-group">
            <label for="rapidActingInsulin">Insulina Lenta </label>
            <input type="number" step="0.1" name="rapidActingInsulin" class="form-control" id="exampleFormControlFile1">
          </div>

          <div class="form-group">

            <input type="submit" name="btn_env" class="btn btn-success" id="exampleFormControlFile1" value="Calcular">
          </div>

        </form>

      </div>
    </div>

  </div>
</section>
@endsection
