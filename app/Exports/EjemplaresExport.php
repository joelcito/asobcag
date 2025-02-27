<?php

namespace App\Exports;

use App\Models\Criadero;
use App\Models\Ejemplar;
use App\Models\Biometria;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EjemplaresExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $criadero_id;

    public function __construct($criadero_id)
    {
        $this->criadero_id = $criadero_id;
    }

    public function array(): array
    {
        // Obtener datos del criadero
        $criadero = Criadero::with(['propietario', 'tecnico', 'pastor'])
                            ->find($this->criadero_id);

        if (!$criadero) {
            return [['Error' => 'Criadero no encontrado']];
        }

        // Obtener los ejemplares asociados
        $ejemplares = Ejemplar::where('criadero_id', $this->criadero_id)
            ->with(['color', 'fenotipo', 'biometrias', 'morfologicos'])
            ->get();

        // Construir los datos en un array
        $data = [];

        // Agregar datos del criadero en una fila independiente
        $data[] = ['CRIADERO:', $criadero->nombre ?? 'N/A'];
        $data[] = ['Propietario:', $criadero->propietario->name ?? 'N/A'];
        $data[] = ['tecnico:', $criadero->tecnico->name ?? 'N/A'];
        $data[] = ['Pastor:', $criadero->pastor->name ?? 'N/A'];

        // Fila vacía como separación
        $data[] = [];

        // Agregar encabezados de los ejemplares
        $data[] = ['ID', 'Nombre', 'Sexo', 'Nro. de Registro', 'Micropchip', 'Arete', 'Fecha de Nacimiento', 'Fecha de Registro', 'Color', 'Fenotipo', 'Raza', 'Biometrias', 'Morfologicos'];

        // Agregar los ejemplares
        foreach ($ejemplares as $ejemplar) {
            $data[] = [
                $ejemplar->id,
                $ejemplar->nombre,
                $ejemplar->sexo,
                $ejemplar->numero_registro,
                $ejemplar->microchip,
                $ejemplar->arete,
                $ejemplar->fecha_nacimiento,
                $ejemplar->fecha_registro,
                $ejemplar->color->nombre ?? 'N/A',
                $ejemplar->fenotipo->nombre ?? 'N/A',
                $ejemplar->raza->nombre ?? 'N/A',
                $this->stringBiometrias($ejemplar->biometrias),
                $this->stringMorfologicos($ejemplar->morfologicos),
            ];
        }

        return $data;
    }

    public function headings(): array
    {
        return [];
    }

    // 👉 Estilos para encabezados en negrita
    public function styles(Worksheet $sheet)
    {
        return [
            // Aplicar negrita a las filas del criadero (1 a 4) y los encabezados de ejemplares (fila 6)
            1 => ['font' => ['bold' => true]],
            2 => ['font' => ['bold' => true]],
            3 => ['font' => ['bold' => true]],
            4 => ['font' => ['bold' => true]],
            5 => ['font' => ['bold' => true]],
        ];
    }

    /* FUNCIONES EXTRAS PARA EL ARRAY */
    public function stringBiometrias(Collection $biometrias){
        if($biometrias->isNotEmpty()){
            $cadena = '';
            $indice = 1;
            foreach($biometrias as $b){
                $cadena = $cadena.'.- '.$indice.
                ' Motivo: '.$b->motivo.
                ' Fecha: '.$b->fecha.
                ' Peso: '.$b->peso.
                ' Altura Cruz: '.$b->altura_cruz.
                ' Altura Grupa: '.$b->altura_grupa.
                ' Altura Cabeza: '.$b->altura_cabeza.
                ' Ancho Pecho: '.$b->ancho_pecho.
                ' Ancho Isquiones: '.$b->ancho_isquiones.
                ' Perimetro Toraxico: '.$b->perimetro_toraxico.
                ' Perimetro Abdominal: '.$b->perimetro_abdominal.
                ' Largo Cuello: '.$b->largo_cuello.
                ' Cuello Perimetro Sup: '.$b->cuello_perimetro_sup.
                ' Cuello Perimetro Inf: '.$b->cuello_perimetro_inf.
                ' Largo Oreja: '.$b->largo_oreja.
                ' Largo Cola: '.$b->largo_cola.
                ' Largo Cuerpo: '.$b->largo_cuerpo.
                ' Diametro Cania Ant: '.$b->diametro_cania_ant.
                ' Diametro Cania Post: '.$b->diametro_cania_post.
                "\n";
                $indice++;
            }
            return $cadena;
        }

        return 'N/A';
    }

    public function stringMorfologicos(Collection $morfologicos){
        if($morfologicos->isNotEmpty()){
            $cadena = '';
            $indice = 1;
            foreach($morfologicos as $m){
                $cadena = $cadena.'.- '.$indice.
                ' Motivo: '.$m->motivo.
                ' Fecha Evaluacion: '.$m->fecha_evaluacion.
                ' Oreja: '.$m->oreja.
                ' Cuello: '.$m->cuello.
                ' Cabeza: '.$m->cabeza.
                ' Alzada: '.$m->alzada.
                ' Largo Cuerpo: '.$m->largo_cuerpo.
                ' Amplitud Pecho: '.$m->amplitud_pecho.
                ' Fortaleza: '.$m->fortaleza.
                ' Balance: '.$m->balance.
                ' Canias: '.$m->canias.
                ' Copete: '.$m->copete.
                ' Linea Superior: '.$m->linea_superior.
                ' Grupa: '.$m->grupa.
                ' Densidad: '.$m->densidad.
                ' Rizo: '.$m->rizo.
                ' Calce: '.$m->calce.
                "\n";
                $indice++;
            }
            return $cadena;
        }

        return 'N/A';
    }

}
