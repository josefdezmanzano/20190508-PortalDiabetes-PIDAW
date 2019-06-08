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
          @if (Auth::user()->hasRole('admin'))
        <div class="card mb-2">
                <div class="card-header">
                    Panel admin
                </div>
                <div class="card-body">
                        <a href="{{route('chart')}}" class="btn btn-warning">Usuarios registrados por mes</a>
                        <a href="{{route('user.index')}}" class="btn btn-warning">Usuarios registrados</a>

                </div>
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


    <a href="{{url()->previous()}}" class="btn btn-info">Volver</a>
    <a  class="btn btn-warning" href="{{route('user.edit', $user)}}">Modificar</a>

        </div>

    </div>
@endsection
