<?php

namespace App\Http\Controllers;

use App\Medicion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Session; //Esto es para usar sesiones
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input; //Para los botones de modificar borrar y actualizar.

class MedicionController extends Controller
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
            $usuario = Auth::user()->id;
            $mediciones = Medicion::with('users')->where('user_id', $usuario)
                ->orderBy('id', 'DESC', 'users_id')->get();
            return View::make('mediciones.index', compact('mediciones'));
        } else {
            return view('auth.login');
        }


        //return view('mediciones.index');
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
            $usuario = Auth::user()->id;
            return view('mediciones.create')->with('usuario', $usuario);
        } else {
            return view('auth.login');
        }

        //DB::table('users')->select('id')->get();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Guardamos los inputs en variables
        $user_id = $request->input('user_id');
        $momento = $request->input('momento');
        $glucose = $request->input('glucose');
        $rations = $request->input('rations');
        $longActingInsulin = $request->input('longActingInsulin');
        $rapidActingInsulin = $request->input('rapidActingInsulin');
        $fechaHoraActual = date('Y-m-d H:i:s');
        //Validamos los inputs
        $request->validate(
            [
                'user_id' => 'required',
                'momento' => 'required',
                'glucose' => 'required',
                'rations' => 'required',
                'longActingInsulin' => 'required',
                'rapidActingInsulin' => 'required'
            ]
        );


        //Insertamos los datos en la tabla
        DB::table('medicions')->insert([
            ['momento' => $momento, 'glucose' => $glucose, 'rations' => $rations, 'longActingInsulin' => $longActingInsulin, 'rapidActingInsulin' => $rapidActingInsulin, 'user_id' => $user_id, 'created_at' => $fechaHoraActual]
        ]);
        //die($request['categorias_id']);
        //*********Calculo de porcentajes de la insulina rapida
        //Calculo del 25%
        $veinticincoRapida = $rapidActingInsulin * 0.25;
        //Calculo del 50%
        $cincuentaRapida = $rapidActingInsulin * 0.50;
        //Calculo del 75%
        $setentaYcincoRapida = $rapidActingInsulin * 0.75;
        //********* FIN Calculo de porcentajes de la insulina rapida

        //*********Calculo de porcentajes de la insulina Lenta
        //Calculo del 25%
        $veinticincoLenta = $longActingInsulin * 0.25;
        //Calculo del 50%
        $cincuentaLenta = $longActingInsulin * 0.50;
        //Calculo del 75%
        $setentaYcincoLenta = $longActingInsulin * 0.75;
        //********* FIN Calculo de porcentajes de la insulina rapida


        //Medicion::create($request->all());


        //Comprobaciones de hipoglucemia
        if ($momento = 'AD' && $glucose < 75) {
            Session::flash('message', 'Bajate 1 Unidad/es de insulina lenta');
        }
        if ($momento = 'AA' && $glucose < 75) {
            Session::flash('message', 'No debes llegar tan bajo a las comidas! recuerda que no debes de pasar grandes tiempos sin ingerir alimentos y si llegas bajo de azucar tomate un zumo esperate 15 minutos y pinchate para poder comer');
        }
        if ($momento = 'AC' && $glucose < 75) {
            Session::flash('message', 'No debes llegar tan bajo a las comidas! recuerda que no debes de pasar grandes tiempos sin ingerir alimentos y si llegas bajo de azucar tomate un zumo esperate 15 minutos y pinchate para poder comer');
        }
        if ($momento = 'N' && $glucose < 90) {
            Session::flash('message', 'Bajate ' . $veinticincoLenta . ' Unidad/es de insulina lenta');
        }
        if ($momento = 'N' && $glucose < 75) {
            Session::flash('message', 'Bajate ' . $cincuentaLenta . ' Unidad/es de insulina lenta');
        }
        if (($momento = 'DD' || $momento = 'DA' || $momento = 'DC') && ($glucose > 80 && $glucose < 100)) {

            Session::flash('message', 'Deberias bajar ' . $veinticincoRapida . ' Unidad/es de insulina rapida');
        }

        if (($momento = 'DD' || $momento = 'DA' || $momento = 'DC') && ($glucose > 70 && $glucose < 80)) {

            Session::flash('message', 'Deberias bajar ' . $cincuentaRapida . ' Unidad/es de insulina rapida');
        }
        if (($momento = 'DD' || $momento = 'DA' || $momento = 'DC') && ($glucose < 70)) {

            Session::flash('message', 'Deberias bajar ' . $setentaYcincoRapida . ' Unidad/es de insulina rapida');
        }
        if (($momento = 'DD' || $momento = 'DA' || $momento = 'DC') && ($glucose < 70 && $rations < 2)) {

            Session::flash('message', 'Un diabetico suele pincharse entre 2 y 4 unidades para 40g de carbohidratos(4 Raciones),
            si no sabe cuanta insulina deberia de pincharse por comida deberia ir al medico para recibir educacion diabetologica
            mientras puede ver este enlace (URL) sobre las pautas de la alimentacion y como controlar la diabetes en el domicilio,
            RECUERDA! NUNCA DEBES DEJAR QUE TUS NIVELES DE AZUCAR ESTEN EN MENOS DE 70! SI ESTO PASA TOMA ALIMENTOS DE ACCION RAPIDA
            COMO UN ZUMO/REFRESCO AZUCARADO O EN SU DEFECTO AZUCAR PURO. no sabes que alimentos son de accion rapida y cuales de accion lenta?
            Pulsa aqui: URL ');
        }


        //Comprobaciones de hiperglucemia
        if ($momento = 'AD' && $glucose > 150) {
            Session::flash('message', 'Estas alto de azucar! pinchate y espera 15 minutos antes de comer!');
        }
        if ($momento = 'AA' && $glucose > 150) {
            Session::flash('message', 'Estas alto de azucar! pinchate y espera 15 minutos antes de comer!');
        }
        if ($momento = 'AC' && $glucose > 150) {
            Session::flash('message', 'Estas alto de azucar! pinchate y espera 15 minutos antes de comer!');
        }
        if (($momento = 'DD' || $momento = 'DA' || $momento = 'DC') && ($glucose > 180 && $glucose < 200)) {

            Session::flash('message', 'Deberias subir ' . $veinticincoRapida . ' Unidad/es de insulina rapida');
        }
        if (($momento = 'DD' || $momento = 'DA' || $momento = 'DC') && ($glucose > 200 && $glucose < 250)) {
            Session::flash('message', 'Deberias subir ' . $cincuentaRapida . ' Unidad/es de insulina rapida');
        }
        if (($momento = 'DD' || $momento = 'DA' || $momento = 'DC') && ($glucose > 250 && $glucose < 300)) {
            Session::flash('message', 'Deberias subir ' . $setentaYcincoRapida . ' Unidad/es de insulina rapida');
        }
        if (($momento = 'DD' || $momento = 'DA' || $momento = 'DC') && ($glucose > 300 && $glucose < 350)) {
            Session::flash('message', 'Deberias subir ' . $rapidActingInsulin . ' Unidad/es de insulina rapida');
        }
        if (($momento = 'DD' || $momento = 'DA' || $momento = 'DC') && ($glucose > 350)) {
            Session::flash('message', 'Vuelve a pincharte las mismas unidades! Puede que no te hayas pinchado bien
                o que la insulina no te haya hecho efecto! Si necesitas ayuda sobre como ponerte insulina visita este enlace: URL
                Te ha pasado lo mismo en la anterior medicion
                ? puede que se te haya puesto mala la insulina, Si quieres saber por que motivos puede ponerse mal la insulina y como prevenirlo visita este enlace: URL. Si sigues estando alto en la siguiente medicion despues de comer visita a un medico');
        }
        if ($momento = 'N' && $glucose > 130) {
            Session::flash('message', 'Deberias subir ' . $veinticincoLenta . ' Unidad/es de insulina lenta');
        }
        if ($momento = 'N' && $glucose < 160) {
            Session::flash('message', 'Deberias subir ' . $cincuentaLenta . ' Unidad/es de insulina lenta');
        }
        if ($momento = 'N' && $glucose < 200) {
            Session::flash('message', 'Deberias subir ' . $setentaYcincoLenta . ' Unidad/es de insulina lenta');
        } else {
            Session::flash('danger', 'Muy Bien! Tienes un buen control de tu diabetes!');
        }


        return redirect()->route('mediciones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicion  $medicion
     * @return \Illuminate\Http\Response
     */
    public function show(Medicion $medicion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicion  $medicion
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicion $medicion, $id)
    {
        //
        if (Auth::check()) {
            $medicion = Medicion::find($id);
            return view('mediciones.edit', compact('medicion'));
        } else {
            return view('auth.login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicion  $medicion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicion $medicion, $id)
    {
        //
        $request->validate(
            [
                'momento' => 'required',
                'glucose' => 'required',
                'rations' => 'required',
                'longActingInsulin' => 'required',
                'rapidActingInsulin' => 'required'
            ]
        );
        $medicion = Medicion::find($id);

        $medicion->update($request->all());
        //$request['portada'] = 'img/generico.jpg';

        //$libro->update($request->all());
        // Libreria::update($request->all());
        //indicamos con un mensaje si todo esta correcto
        Session::flash('message', 'Medición actualizada correctamente.');
        return redirect()->route('mediciones.index'); //volvemos ha inicio
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicion  $medicion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicion $medicion, $id)
    {
        //
        $medicionBorrada = Medicion::find($id);
        $medicionBorrada->delete();
        //indicamos con un mensaje si todo esta correcto
        Session::flash('message', 'Medicion borrada correctamente');
        return redirect()->route('mediciones.index'); //volvemos ha inicio


    }
}
