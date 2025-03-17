<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ejemplar;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $propietarios       = User::where('rol_id', 2)->count();
        $usuariosDelSistema = User::where('rol_id', 1)->count();
        $llama              = Ejemplar::where('tipo', 'LLAMA')->count();
        $alpacas            = Ejemplar::where('tipo', 'ALPACA')->count();


        $registrosEjemplaresLlama = array();
        $registrosEjemplaresAlpaca = array();

        for($i = 1 ; $i <= 12 ; $i++){

            $inidate = date("Y")."-".(($i<=9)? '0'.$i : $i )."-01";
            $findate = date("Y")."-".(($i<=9)? '0'.$i : $i )."-".cal_days_in_month(CAL_GREGORIAN, (($i<=9)? '0'.$i : $i ) , date("Y"));

            $cantiodadREgistroMesLlama = Ejemplar::whereBetween('created_at',["$inidate","$findate"])
                                                ->where('tipo', 'LLAMA')
                                                ->count();
            array_push($registrosEjemplaresLlama, $cantiodadREgistroMesLlama);


            $cantiodadREgistroMesAlpaca = Ejemplar::whereBetween('created_at',["$inidate","$findate"])
                                                    ->where('tipo', 'ALPACA')
                                                    ->count();
            array_push($registrosEjemplaresAlpaca, $cantiodadREgistroMesAlpaca);

        }

        // Contar machos y hembras menores a un año
        $ejemplarLlamas1 = Ejemplar::selectRaw("sexo, COUNT(*) as cantidad")
                            ->whereRaw("TIMESTAMPDIFF(YEAR, ejemplares.fecha_nacimiento, NOW()) <= 1") 
                            ->groupBy('sexo')
                            ->get();
        // Contar machos y hembras en rango 1 y 2 años
        $ejemplarLlamas2 = Ejemplar::selectRaw("sexo, COUNT(*) as cantidad")
                            ->whereRaw("TIMESTAMPDIFF(YEAR, ejemplares.fecha_nacimiento, NOW()) > 1")
                            ->whereRaw("TIMESTAMPDIFF(YEAR, ejemplares.fecha_nacimiento, NOW()) <= 2")
                            ->groupBy('sexo')
                            ->get();
        // Contar machos y hembras en rango 2 y 3 años
        $ejemplarLlamas3 = Ejemplar::selectRaw("sexo, COUNT(*) as cantidad")
                            ->whereRaw("TIMESTAMPDIFF(YEAR, ejemplares.fecha_nacimiento, NOW()) > 2")
                            ->whereRaw("TIMESTAMPDIFF(YEAR, ejemplares.fecha_nacimiento, NOW()) <= 3")
                            ->groupBy('sexo')
                            ->get();

        return view('home.inicio')->with(compact('propietarios', 'usuariosDelSistema', 'llama', 'alpacas', 'registrosEjemplaresLlama', 'registrosEjemplaresAlpaca', 'ejemplarLlamas1', 'ejemplarLlamas2', 'ejemplarLlamas3'));
    }
}
