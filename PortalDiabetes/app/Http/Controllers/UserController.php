<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Session;//requerido para usar sesiones
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Auth::user()->authorizeRoles(['admin']); //esto es para permitir o no a un usuario entrar a una vista

        if (Auth::check()) {
           // Auth::user()->hasRole('admin')
           // $usuario = Auth::user()->id;
            $usuarios = User::orderBy('id', 'DESC', 'name')->paginate(10);
            return View::make('user.index', compact('usuarios'));
        } else {
            return view('auth.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if((Auth::user()->id == $id) || (Auth::user()->hasRole('admin'))){
        //
        $user = User::find($id);
        return view('user.edit', compact('user'));
        }else{
            Auth::user()->authorizeRoles([]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //4
        if((Auth::user()->id == $id) || (Auth::user()->hasRole('admin'))){


        $request->validate(

            [
                'name' => 'required',
                'email' => 'required',
                'diabetic' => 'required',
            ]
        );

        $user = User::find($id);
        if ($request->file('image')) {

            $image = $request->file('image');
            $new_name = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('storage'), $new_name);
            $request = $request->except('image');
            $request['image'] = 'storage/' . $new_name;
            $user->update($request);


        } else {
            $user->update($request->all());

        }
        Session::flash('message','Usuario actualizado correctamente.');
        return redirect()->route('user.show',$id);//volvemos ha inicio
    }else{
        Auth::user()->authorizeRoles([]); //esto es para permitir o no a un usuario entrar a una vista

    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if((Auth::user()->id == $id) || (Auth::user()->hasRole('admin'))){
        $medicionBorrada = Medicion::find($id);
        $medicionBorrada->delete();
        //indicamos con un mensaje si todo esta correcto
        Session::flash('message', 'Medicion borrada correctamente');
        return redirect()->route('mediciones.index'); //volvemos ha inicio
        }else{
        Auth::user()->authorizeRoles([]); //esto es para permitir o no a un usuario entrar a una vista dependiendo de su rol

        }

    }
}
