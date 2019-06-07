@extends('layouts.app')

@section('content')
<div class="container">
        <center><h1 style="text-align: center;font-family: 'Staatliches', cursive;">Actualizar información personal</h1></center>

            <form name="f1" action="{{route('user.update', $user->id)}}" enctype="multipart/form-data" method="POST">
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
                        <label for="titulo">Nombre </label>
                        <input type="text" name="name" class="form-control" id="exampleFormControlFile1" value="{{$user->name}}">
                     </div>

                 <div class="form-group">
                        <label for="sinopsis">Email </label>
                  <input type="text" name="email" class="form-control" id="exampleFormControlFile1" value="{{$user->email}}">
                     </div>

                 <div class="form-group">
                        <label for="stock">Diabetico? </label>
                        <select id="diabetic" name='diabetic' class="custom-select" id="inputGroupSelect01">
                                <!-- comprobamos lo que tiene actualmente-->
                                @if ($user->diabetic=='SI')
                                <option selected value="SI">SI</option>
                                <option value="NO">NO</option>
                                @else
                                <option value="SI">SI</option>
                                <option selected value="NO">NO</option>
                                @endif

                            </select>
               </div>
        <div class="form-group">
            <label for="Portada">Foto perfil</label>
       <img style="border-radius: 50px 50px; margin:1%;" src={{asset($user->image)}} height="50" width="50">

       <div class="input-group mb-3">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" name='image'>
              <label class="custom-file-label" for="inputGroupFile03">Elige un archivo</label>
            </div>
          </div>
          </div>
            <div class="form-group">
                  <input type="submit"  name="btn_env" class="btn btn-success" id="exampleFormControlFile1" value="Actualizar">
                  <a href="{{route('user.show',$user->id)}}" class="btn btn-info">Volver</a>
            </div>
                    @csrf
                </form>
        </div>
        @endsection
