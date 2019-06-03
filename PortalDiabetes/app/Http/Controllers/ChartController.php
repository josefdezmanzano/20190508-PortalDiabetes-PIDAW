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
            $mediciones = DB::table('medicions')->select('glucose')->where('user_id',$usuario)->get();

            $array=collect($mediciones)->toArray();

            foreach ($mediciones['mediciones'] as $key => $value) {
                $mediciones['mediciones'][$key] = (object) $value;
            }

            $chart = Charts::multi('areaspline', 'highcharts')
            ->title('My nice chart')
            ->colors(['#ff0000', '#ffffff'])
            ->dataset('John', [3, 4, 3, 5, 4, 10, 12])
            ->dataset('Jane',  [1, 3, 4, 3, 3, 5, 4]);

            return view('chartMediciones', compact('mediciones'));
        } else {
            return view('auth.login');
        }
    }
}
