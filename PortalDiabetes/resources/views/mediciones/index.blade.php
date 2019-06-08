@extends('layouts.app')
@section('css')
    <style>
        .grid-container {
  display: grid;
  grid-column-gap: 5px;
  grid-template-columns: auto auto auto;


}

.grid-item {


  padding: 2%;
  font-size: 30px;
  text-align: center;
}
        </style>
@endsection
@section('content')

<section id="about" class="about-section text-center">
  <div class="container">
    <div class="row">

      <div class="col-lg-8 mx-auto">

            @if (Session::has('danger'))
            <div class="alert alert-danger">{{ Session::get('danger') }}</div>
            @else
            @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            @endif

      </div>
    </div>

    <center><h1 style="text-align: center;font-family: 'Staatliches', cursive;">Tus mediciones</h1></center>

  <a style=' text-align:right; float:right;' class="btn btn-secondary m-3" href="{{route('chartMediciones')}}">Grafico</a>

    <table class="table table-responsive table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col" class="align-middle">Usuario</th>
            <th scope="col" class="align-middle">Glucosa(mmg/dl)</th>
            <th scope="col" class="align-middle">Momento</th>
            <th scope="col" class="align-middle">Insulina Rapida</th>
            <th scope="col" class="align-middle">Insulina Lenta</th>
            <th scope="col" class="align-middle">Raciones</th>
            <th scope="col" class="align-middle">Fecha de medicion</th>
            <th scope="col" class="align-middle">Fecha de ultima modificación</th>
            <th scope="col" class="align-middle">Acciones</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($mediciones as $medicion)

          <tr>
            <th scope="row" class="align-middle">{{$medicion->users->name}}</th>
            @if ($medicion->glucose > 180)
            <td class="p-3 mb-2 bg-danger text-white align-middle">{{$medicion->glucose}}</td>
            @else
            <td class="align-middle">{{$medicion->glucose}}</td>
            @endif
            <td class="align-middle">{{$medicion->momento}}</td>
            <td class="align-middle">{{$medicion->rapidActingInsulin}}</td>
            <td class="align-middle">{{$medicion->longActingInsulin}}</td>
            <td class="align-middle">{{$medicion->rations}}</td>
            <td class="align-middle">{{$medicion->created_at}}</td>
            <td class="align-middle">{{$medicion->updated_at}}</td>
            <td class="align-middle">
                <div class="grid-container">
<div class="grid-item"> <a  class="btn btn-warning" href="{{route('mediciones.edit', $medicion)}}"><i class="material-icons">
        edit
        </i></a></div>
<div class="grid-item">  <a href="{{route('mediciones.show', $medicion->id)}}" class="btn btn-info"><i class="material-icons">
        description
        </i></a></div>
<div class="grid-item"> <form action="{{ route('mediciones.destroy',$medicion->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit"><i class="material-icons">
            delete_forever
            </i></button>
    </form></div>
</div>





            </td>


        </tr>
        @endforeach
        {{ $mediciones->links() }}
        </tbody>
      </table>

      <a href="{{url()->previous()}}" class="btn btn-info" style="float:left;">Volver</a>
<br>


  </div>
</section>
@endsection
