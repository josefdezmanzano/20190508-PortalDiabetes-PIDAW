<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use DevDojo\Chatter\Models\Category;
use Illuminate\Support\Facades\View;

class ChatterCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::check()) {
            //$usuario = Auth::user()->id;
            $categorias = Category::orderBy('id', 'DESC', 'name')->paginate(10);
            return View::make('chattercategory.index', compact('categorias'));
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
        if (Auth::check()) {
            //$usuario = Auth::user()->id;
            return view('chattercategory.create');
        } else {
            return view('auth.login');
        }
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
         //Guardamos los inputs en variables
         $nombre = $request->input('nombre');
         $color = $request->input('color');
         $etiqueta = $request->input('etiqueta');
         $fechaHoraActual = date('Y-m-d H:i:s');
         //Validamos los inputs
         $request->validate(
             [
                 'nombre' => 'required',
                 'color' => 'required',
                 'etiqueta' => 'required',
             ]
         );


         //Insertamos los datos en la tabla
         DB::table('chatter_categories')->insert([
             ['name'       => $nombre,
             'color'      => $color,
             'slug'       => $nombre,
             'created_at' => $fechaHoraActual]
         ]);
         Session::flash('message', 'Categoria insertada correctamente.');
         return redirect()->route('chatter.home'); //volvemos ha inicio
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if (Auth::check()) {
            $category = Category::find($id);
            return view('chattercategory.edit', compact('category'));
        } else {
            return view('auth.login');
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
        //
         //Guardamos los inputs en variables
         $nombre = $request->input('name');
         $color = $request->input('color');
         $etiqueta = $request->input('slug');
         $fechaHoraActual = date('Y-m-d H:i:s');
         //Validamos los inputs
         $request->validate(
             [
                 'name' => 'required',
                 'color' => 'required',
                 'slug' => 'required',
             ]
         );
        $category = Category::find($id);
//dd($request->all());
        $category->update($request->all());
        //$request['portada'] = 'img/generico.jpg';


        //indicamos con un mensaje si todo esta correcto
        Session::flash('message', 'Categoria actualizada correctamente.');
        return redirect()->route('category.index'); //volvemos ha inicio
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
        $categoriaBorrada = Category::find($id);
        //print_r($categoriaBorrada);
        $categoriaBorrada->delete();
        //indicamos con un mensaje si todo esta correcto
        Session::flash('message', 'categoria borrada correctamente');
        return redirect()->route('category.index'); //volvemos ha inicio
    }
}
