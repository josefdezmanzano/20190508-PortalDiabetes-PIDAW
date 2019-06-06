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
            $mediciones = DB::table('medicions')->select('id', 'glucose', 'created_at')->where('user_id', $usuario)->get();

            $mapped = $mediciones->map(function ($mediciones) {
                return $mediciones->glucose;
            });
            $mapped2 = $mediciones->map(function ($mediciones) {
                return $mediciones->created_at;
            });

            $fechasFinal=[];
            foreach ($mapped2 as $key => $value) {

                array_push($fechasFinal,$value);
            }

            $final=[];
            foreach ($mapped as $key => $value) {

                array_push($final,$value);
            }
            //$final=substr_replace($final, '', strlen($final)-1);

           // print_r($final);
           // print_r($fechasFinal);

//die();
            //dd($mapped);
            //dd($mapped2);
            $chart = Charts::multi('areaspline', 'highcharts')
                ->title("Mediciones")
                ->elementLabel("Glucosa")
                ->colors(['#0cbcfe', '#ffffff'])
                ->dimensions(500, 500)
                ->responsive(true)
                ->labels($fechasFinal)
                ->dataset('Mediciones', $final);

            //$chart->labels(['2 days ago', 'Yesterday', 'Today']);
            //$chart->dataset('My dataset', [$users_2_days_ago, $yesterday_users, $glucose]);
            return view('chartMediciones', compact('chart'));
        } else {
            return view('auth.login');
        }
    }
}
