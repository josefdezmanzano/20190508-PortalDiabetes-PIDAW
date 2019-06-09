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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
@endsection
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

<br/>

    <table id='table_id' class="table table-responsive table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col" class="align-middle">ID</th>
            <th scope="col" class="align-middle">ID DE CATEGORIA PADRE</th>
            <th scope="col" class="align-middle">ORDEN</th>
            <th scope="col" class="align-middle">NOMBRE</th>
            <th scope="col" class="align-middle">COLOR</th>
            <th scope="col" class="align-middle">ETIQUETA</th>
            <th scope="col" class="align-middle">CREADO EL</th>
            <th scope="col" class="align-middle">ACTUALIZADO EL</th>
            <th scope="col" class="align-middle">ACCIONES</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)

          <tr>
            <th scope="row" class="align-middle">{{$categoria->id}}</th>
            <td class="align-middle">{{$categoria->parent_id}}</td>
            <td class="align-middle">{{$categoria->order}}</td>
            <td class="align-middle">{{$categoria->name}}</td>
            <td bgcolor="{{$categoria->color}}" style="border-radius: 20% 20%;" class="align-middle"></td>
            <td class="align-middle">{{$categoria->slug}}</td>
            <td class="align-middle">{{$categoria->created_at}}</td>
            <td class="align-middle">{{$categoria->updated_at}}</td>

            <td class="align-middle">
                    <div class="grid-container">
                            <div class="grid-item">  <a  class="btn btn-warning" style="width:100%;" href="{{route('category.edit', $categoria)}}"><i class="material-icons">
                                    edit
                                    </i></a></div>
                            <div class="grid-item">
                                <form style="width:100%; margin-top:1%" action="{{ route('category.destroy',$categoria->id)}}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <button style="width:100%;" class="btn btn-danger" type="submit"><i class="material-icons">
                                            delete_forever
                                            </i></button>
                                </form></div>

            </td>
        </div>


        </tr>
        @endforeach
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js" defer></script>
        <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
        </script>
        </tbody>
      </table>
      <a href="{{url()->previous()}}" class="btn btn-info" style="float:left;">Volver</a>


  </div>
</section>
@endsection
