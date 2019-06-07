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

    <center><h1 style="text-align: center;font-family: 'Staatliches', cursive;">Categorias</h1></center>

    <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">COLOR</th>
            <th scope="col">ETIQUETA</th>
            <th scope="col">Acciones</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)

          <tr>
            <th scope="row">{{$categoria->id}}</th>
            <td>{{$categoria->name}}</td>
            <td bgcolor="{{$categoria->color}}"></td>
            <td>{{$categoria->slug}}</td>

            <td>
                <a  class="btn btn-warning" href="{{route('category.edit', $categoria)}}">Modificar</a>
                <form style="display: inline;" action="{{ route('category.destroy',$categoria->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Borrar</button>
                </form>

            </td>


        </tr>
        @endforeach
        {{ $categorias->links() }}
        </tbody>
      </table>

      <a href="{{url()->previous()}}" class="btn btn-info" style="float:left;">Volver</a>


  </div>

</section>
@endsection
