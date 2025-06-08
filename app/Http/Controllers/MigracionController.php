<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MigracionController extends Controller
{
    public function migracion(Request $request){

        $filePath = public_path('assets/estructura_bolivia_0.xlsx');

        // Cargar el archivo con PhpSpreadsheet (Laravel Excel lo usa internamente)
        $spreadsheet = IOFactory::load($filePath);
        // $sheet = $spreadsheet->getActiveSheet();
        $sheet = $spreadsheet->getSheet(1);
        $rows = $sheet->toArray();

        $contador = 0;

        foreach ($rows as $index => $row) {
            echo $row[0]." ".$row[4]."<br>";

            $id_ubicacion_geografica          = $row[0];
            $id_pais                          = $row[1];
            $id_nivel_geografico              = $row[2];
            $id_ubicacion_geografica_superior = $row[3];
            $nombre                           = $row[4];

            // dd($id_ubicacion_geografica_superior);

            if($id_ubicacion_geografica_superior == null){

                $localidad                     = new Localidad();
                $localidad->usuario_creador_id = Auth::user()->id;
                $localidad->superior_id        = 1;
                $localidad->nombre             = $nombre;
                $localidad->nivel              = $id_nivel_geografico+1;
                $localidad->estado             = $id_ubicacion_geografica;
                $localidad->save();

            }else{
                $localidadSuperior = Localidad::where('estado',$id_ubicacion_geografica_superior)->first();

                // dd(
                //     $localidadSuperior,
                //     $id_ubicacion_geografica_superior
                // );

                if($localidadSuperior){

                    $localidad                     = new Localidad();
                    $localidad->usuario_creador_id = Auth::user()->id;
                    $localidad->superior_id        = $localidadSuperior->id;
                    $localidad->nombre             = $nombre;
                    $localidad->nivel              = $id_nivel_geografico+1;
                    $localidad->estado             = $id_ubicacion_geografica;
                    $localidad->save();

                }else{
                    break;
                }
            }

            if($contador > 10)
                break;

            $contador++;
        }

    }
}
