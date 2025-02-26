<?php

namespace App\Exports;

use App\Models\Criadero;
use App\Models\Ejemplar;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EjemplaresExport implements FromArray, WithHeadings, ShouldAutoSize
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
            ->with(['color', 'fenotipo'])
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
        $data[] = ['ID', 'Nombre', 'Sexo', 'Nro. de Registro', 'Micropchip', 'Arete', 'Fecha de Nacimiento', 'Fecha de Registro', 'Color', 'Fenotipo', 'Raza'];

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
            ];
        }

        return $data;
    }

    public function headings(): array
    {
        return [];
    }
}
