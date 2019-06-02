<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Charts;
use App\User;
use DB;
use App\Medicion;
use Auth;
// pruebas


class ChartController extends Controller
{
    //
    public function index()
    {
        //
        $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))
            ->get();
        $chart = Charts::database($users, 'area', 'highcharts')
            ->title("Usuarios registrados por mes")
            ->elementLabel("Total de usuarios")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->groupByMonth(date('Y'), true);


        return view('chart', compact('chart'));
    }


    public function mediciones()

    {
        if (Auth::check()) {
            $usuario = Auth::user()->id;
            $mediciones = Medicion::where(DB::raw("user_id"), $usuario)
                ->get();

            $chart = Charts::database($mediciones, 'area', 'highcharts')
                ->title("Grafico de mediciones")
                ->elementLabel("Mediciones")
                ->dimensions(1000, 500)
                ->responsive(true)
                ->groupBy('glucose');

            return view('chartMediciones', compact('chart'));
        } else {
            return view('auth.login');
        }
    }
}
