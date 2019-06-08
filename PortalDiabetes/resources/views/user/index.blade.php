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

    <center><h1 style="text-align: center;font-family: 'Staatliches', cursive;">Usuarios totales</h1></center>

  <a style='text-align:right; float:right;' class="btn btn-secondary m-3" href="{{route('chartMediciones')}}">Grafico</a>

    <table class="table table-responsive table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col" class="align-middle">Rol</th>
            <th scope="col" class="align-middle">Nombre</th>
            <th scope="col" class="align-middle">Email</th>
            <th scope="col" class="align-middle">Imagen</th>
            <th scope="col" class="align-middle">Diabetico</th>
            <th scope="col" class="align-middle">Fecha de creación</th>
            <th scope="col" class="align-middle">Fecha de ultima modificación</th>
            <th scope="col" class="align-middle">Acciones</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)

          <tr>

            @if ($usuario->hasRole('admin'))
            <td class="align-middle">Administrador</td>
            @endif
            @if ($usuario->hasRole('user'))
            <td class="align-middle">Usuario</td>
            @endif

            <td scope="row" class="align-middle">{{$usuario->name}}</td>
            <td class="align-middle">{{$usuario->email}}</td>
            <td class="align-middle"> <img style="border-radius: 50px 50px; margin:1%;" src={{asset($usuario->image)}} height="50" width="50"></td>
            <td class="align-middle">{{$usuario->diabetic}}</td>
            <td class="align-middle">{{$usuario->created_at}}</td>
            <td class="align-middle">{{$usuario->updated_at}}</td>



            <td class="align-middle">
                <div class="grid-container">
<div class="grid-item"> <a  class="btn btn-warning" href="{{route('user.edit', $usuario)}}"><i class="material-icons">
        edit
        </i></a></div>
<div class="grid-item">  <a href="{{route('user.show', $usuario->id)}}" class="btn btn-info"><i class="material-icons">
        description
        </i></a></div>
<div class="grid-item"> <form action="{{ route('user.destroy',$usuario->id)}}" method="POST">
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
        {{ $usuarios->links() }}
        </tbody>
      </table>

      <a href="{{url()->previous()}}" class="btn btn-info" style="float:left;">Volver</a>
<br>


  </div>
</section>
@endsection
