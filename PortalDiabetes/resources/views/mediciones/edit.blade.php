@extends('layouts.app')

@section('content')
<div class="container">
<center><h1 style="text-align: center;font-family: 'Staatliches', cursive;">Actualizar información</h1></center>

    <form name="f1" action="{{route('mediciones.update', $medicion->id)}}" enctype="multipart/form-data" method="POST">
                <!-- CONTROLAMOS LOS ERRORES DEL VALIDATE STORE -->
                @if($errors->any)
                <div>

                <ul>
                    @foreach($errors->all() as $el_error)
                    <li class="alert alert-danger">{{$el_error}}</li>
                    @endforeach
                </ul>

                </div>
                @endif
                @method('PUT') <!--comprobar -->
                <!--<input name="_method" type="hidden" value="PUT">-->
                <div class="form-group">
                  <label for="momento"> Momento del día </label>
                <p>El momento del día es <b>{{ $medicion->momento }}</b> Puede cambiarlo mas abajo</p>

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
                  <input type="number" name="glucose" class="form-control" id="exampleFormControlFile1" value='{{$medicion->glucose}}'>
                  </div>

                  <div class="form-group">
                    <label for="rations">Raciones </label>
                    <input type="number" step="0.1" name="rations" class="form-control" id="exampleFormControlFile1" value='{{$medicion->rations}}'>
                  </div>

                  <div class="form-group">
                    <label for="longActingInsulin">Insulina rapida</label>
                    <input type="number" step="0.1" name="longActingInsulin" class="form-control" id="exampleFormControlFile1" value='{{$medicion->longActingInsulin}}'>
                  </div>

                  <div class="form-group">
                    <label for="rapidActingInsulin">Insulina Lenta </label>
                    <input type="number" step="0.1" name="rapidActingInsulin" class="form-control" id="exampleFormControlFile1" value='{{$medicion->rapidActingInsulin}}'>
                  </div>

                <div class="form-group">
              <input type="submit"  name="btn_env" class="btn btn-success" id="exampleFormControlFile1">
            <a href="{{route('mediciones.index')}}" class="btn btn-info">Volver</a>
            </div>
            @csrf
        </form>
</div>
@endsection
