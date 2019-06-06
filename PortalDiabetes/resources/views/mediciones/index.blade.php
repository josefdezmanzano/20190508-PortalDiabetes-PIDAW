@extends('layouts.app')

@section('content')

<section id="about" class="about-section text-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
      </div>
    </div>

    <center><h1 style="text-align: center;font-family: 'Staatliches', cursive;">Tus mediciones</h1></center>

  <a style=' text-align: right;float: right;' class="btn btn-secondary m-3" href="{{route('chartMediciones')}}">Grafico</a>
    <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">Usuario</th>
            <th scope="col">Glucosa(mmg/dl)</th>
            <th scope="col">Momento</th>
            <th scope="col">Insulina Rapida</th>
            <th scope="col">Insulina Lenta</th>
            <th scope="col">Raciones</th>
            <th scope="col">Fecha de medicion</th>
            <th scope="col">Fecha de ultima modificación</th>
            <th scope="col">Acciones</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($mediciones as $medicion)

          <tr>
            <th scope="row">{{$medicion->users->name}}</th>
            <td>{{$medicion->glucose}}</td>
            <td>{{$medicion->momento}}</td>
            <td>{{$medicion->rapidActingInsulin}}</td>
            <td>{{$medicion->longActingInsulin}}</td>
            <td>{{$medicion->rations}}</td>
            <td>{{$medicion->created_at}}</td>
            <td>{{$medicion->updated_at}}</td>
            <td>
                <a  class="btn btn-warning" href="{{route('mediciones.edit', $medicion)}}">Modificar</a>
                <a  href="{{route('mediciones.show', $medicion->id)}}" class="btn btn-info">Detalles</a>

                <form style="display: inline;" action="{{ route('mediciones.destroy',$medicion->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Borrar</button>
                </form>

            </td>


        </tr>
        @endforeach
        {{ $mediciones->links() }}
        </tbody>
      </table>



  </div>
</section>
@endsection
