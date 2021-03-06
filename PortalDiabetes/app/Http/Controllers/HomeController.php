<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
       // print_r(Auth::user()->hasRole('admin'));
        //die();
        $request->user()->authorizeRoles(['user', 'admin']); //esto es para permitir o no a un usuario entrar a una vista

        return view('home');
    }
}
