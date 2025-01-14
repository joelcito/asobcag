<?php

namespace App\Http\Controllers;

use App\Models\Comunidad;
use App\Models\Ejemplar;
use App\Models\Raza;
use App\Models\User;
use App\Utils\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EjemplarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function formulario(Request $request, $ejemplar_id){

        $razas              = Raza::all();
        $ejemplarModel      = new Ejemplar();
        $usuarioModel       = new User();
        $id_rol_propietario = 2;
        $cominidades        = Comunidad::all();

        $propietarios            = $usuarioModel->listaUsuarios($id_rol_propietario);
        $numeroRegistroSiguiente = $ejemplarModel->sacarCorrelativoRegsitro();
        return view('ejemplar.formulario')->with(compact('razas', 'numeroRegistroSiguiente', 'propietarios', 'cominidades'));
    }

    public function guardar(Request $request){
        if($request->ajax()){

            $usuario     = Auth::user();

            $nombre             = $request->input('nombre');
            $sexo               = $request->input('sexo');
            $color              = $request->input('color');
            $raza_id            = $request->input('raza_id');
            $fecha_nacimiento   = $request->input('fecha_nacimiento');
            $color_tradicional  = $request->input('color_tradicional');
            $numero_arete       = $request->input('numero_arete');
            $comunidad_id       = $request->input('comunidad_id');
            $propietario_id     = $request->input('propietario_id');
            $fecha_registro     = $request->input('fecha_registro');
            $padre_id           = $request->input('padre_id');
            $madre_id           = $request->input('madre_id');
            $peso_nacimiento    = $request->input('peso_nacimiento');
            $peso_vivo          = $request->input('peso_vivo');
            $perimetro_toracico = $request->input('perimetro_toracico');
            $altura_cruz        = $request->input('altura_cruz');
            $altura_grupa       = $request->input('altura_grupa');
            $largo_cuerpo       = $request->input('largo_cuerpo');
            $ancho_anca         = $request->input('ancho_anca');
            $largo_cuello       = $request->input('largo_cuello');

            $ejemplar                     = new Ejemplar();
            $ejemplar->usuario_creador_id = $usuario->id;
            $ejemplar->nombre             = $nombre;
            $ejemplar->propietario_id     = $propietario_id;
            $ejemplar->raza_id            = $raza_id;
            $ejemplar->padre_id           = $padre_id;
            $ejemplar->madre_id           = $madre_id;
            $ejemplar->comunidad_id       = $comunidad_id;
            $ejemplar->numero_registro    = $ejemplar->sacarCorrelativoRegsitro();
            $ejemplar->color              = $color;
            $ejemplar->sexo               = $sexo;
            $ejemplar->fecha_nacimiento   = $fecha_nacimiento;
            $ejemplar->fecha_registro     = $fecha_registro;
            $ejemplar->color_tradicional  = $color_tradicional;
            $ejemplar->numero_arete       = $numero_arete;
            $ejemplar->peso_nacimiento    = $peso_nacimiento;
            $ejemplar->peso_vivo          = $peso_vivo;
            $ejemplar->perimetro_toracico = $perimetro_toracico;
            $ejemplar->altura_cruz        = $altura_cruz;
            $ejemplar->altura_grupa       = $altura_grupa;
            $ejemplar->largo_cuerpo       = $largo_cuerpo;
            $ejemplar->ancho_anca         = $ancho_anca;
            $ejemplar->largo_cuello       = $largo_cuello;
            $ejemplar->save();


            // $pais                     = new Pais();
            // $pais->usuario_creador_id = $usuario->id;
            // $pais->nombre             = $nombre;
            // $pais->save();

            $data = Respuesta::success(null, "Se proceso con exito");

        }else{
            $data = Respuesta::error(null, "No existe");
        }
        return $data;
    }

    public function listado(Request $request){
        return view('ejemplar.listado');
    }

    public function ajaxListado(Request $request){
        if($request->ajax()){
            $ejemplares = Ejemplar::all();
            $valores = [
                'listado' => view('ejemplar.ajaxListado')->with(compact('ejemplares'))->render()
            ];
            $data = Respuesta::success($valores, "Datos obtenidos correctamente");
        }else{
            $data = Respuesta::error(null, "Error al obtener los datos");
        }
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ejemplar $ejemplar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ejemplar $ejemplar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ejemplar $ejemplar)
    {
        //
    }
}
