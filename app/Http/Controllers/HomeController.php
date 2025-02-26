<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // $cantidaEmpresas = Empresa::count();
        // $empresa = Auth::user()->empresa;
        // return view('home.inicio')->with(compact('cantidaEmpresas', 'empresa'));
        return view('home.inicio');
    }
}
