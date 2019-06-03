@extends('layouts.app')

@section('content')
<div class="container">
        @if($errors->any)
        <div>

        <ul>
            @foreach($errors->all() as $el_error)
            <li class="alert alert-danger">{{$el_error}}</li>
            @endforeach
        </ul>

        </div>
        @endif
        <div class="table-responsive-xl text-center p-3 mb-2">
                <center><h2>{{$user->name}}</h2></center>

       <img style="border-radius: 50px 50px; margin:1%;" src={{asset($user->image)}} height="150" width="150">


       <table class="table table-borderless table-hover table-dark" style="border-radius: 10px 10px; margin-top:1%;" >
            <thead>
            <tr>
              <th>Email</th>
              <th>Diabetico</th>
              <th>Fecha de ingreso</th>
            </tr>
        </thead>
        <tbody>
        <tr>
              <td>{{$user->email}}</td>
              <td>{{$user->diabetic}}</td>
              <td>{{$user->created_at}}</td>
            </tr>
        </tbody>
          </table>


    <a href="{{route('recomendaciones.index')}}" class="btn btn-info">Volver</a>
    <a  class="btn btn-warning" href="{{route('user.edit', $user)}}">Modificar</a>

        </div>

    </div>
@endsection
