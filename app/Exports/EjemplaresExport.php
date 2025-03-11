<?php

namespace App\Exports;

use App\Models\Criadero;
use App\Models\Ejemplar;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMergedCells;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\View\View;

class EjemplaresExport implements /* FromArray, WithHeadings, WithStyles, ShouldAutoSize, */ FromView
{
    protected $criadero_id;
    protected $mergeCells = [];

    public function __construct($criadero_id)
    {
        $this->criadero_id = $criadero_id;
    }

    /* public function array(): array
    {
        $criadero = Criadero::with(['propietario', 'tecnico', 'pastor'])
                            ->find($this->criadero_id);

        if (!$criadero) {
            return [['Error' => 'Criadero no encontrado']];
        }

        $ejemplares = Ejemplar::where('criadero_id', $this->criadero_id)
            ->with(['color', 'fenotipo', 'raza', 'biometrias', 'morfologicos'])
            ->get();

        $data = [];

        // Agregar información del criadero
        $data[] = ['CRIADERO:', $criadero->nombre ?? 'N/A'];
        $data[] = ['Propietario:', $criadero->propietario->name ?? 'N/A'];
        $data[] = ['Técnico:', $criadero->tecnico->name ?? 'N/A'];
        $data[] = ['Pastor:', $criadero->pastor->name ?? 'N/A'];
        $data[] = [];

        // Encabezados de la tabla
        $headers = ['ID', 'Nombre', 'Sexo', 'Nro. Registro', 'Microchip', 'Arete', 'Fecha Nac.', 'Fecha Reg.', 'Color', 'Fenotipo', 'Raza', 'Biometrías', 'Morfología'];
        $data[] = $headers;

        // Registro de datos
        $startRow = 7; // Comienza después de los encabezados

        foreach ($ejemplares as $ejemplar) {
            // Determinar la cantidad de filas a fusionar
            $maxFilas = max($ejemplar->biometrias->count(), $ejemplar->morfologicos->count());
            $maxFilas = $maxFilas > 0 ? $maxFilas : 1; // Al menos una fila

            // Agregar datos del ejemplar en la primera fila
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
                '', // Espacio reservado para Biometrías
                ''  // Espacio reservado para Morfología
            ];

            // Guardar las celdas a fusionar para los datos del ejemplar (columnas 1-11)
            $this->mergeCells[] = ["A$startRow:J" . ($startRow + $maxFilas - 1)];

            // Agregar las biometrias y morfologías alineadas
            for ($i = 0; $i < $maxFilas; $i++) {
                $biometriaTexto = isset($ejemplar->biometrias[$i]) ? 
                    "📌 #".($i + 1)." - Motivo: {$ejemplar->biometrias[$i]->motivo}, Fecha: {$ejemplar->biometrias[$i]->fecha}, Peso: {$ejemplar->biometrias[$i]->peso} kg" 
                    : '';

                $morfologicoTexto = isset($ejemplar->morfologicos[$i]) ? 
                    "📌 #".($i + 1)." - Motivo: {$ejemplar->morfologicos[$i]->motivo}, Evaluación: {$ejemplar->morfologicos[$i]->fecha_evaluacion}, Oreja: {$ejemplar->morfologicos[$i]->oreja}" 
                    : '';

                if ($i > 0) {
                    $data[] = ['', '', '', '', '', '', '', '', '', '', '', $biometriaTexto, $morfologicoTexto];
                } else {
                    $data[count($data) - 1][11] = $biometriaTexto;
                    $data[count($data) - 1][12] = $morfologicoTexto;
                }
            }

            // Avanzar la fila de inicio para el siguiente ejemplar
            $startRow += $maxFilas;
        }

        return $data;
    }

    public function headings(): array
    {
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Negrita en encabezado de criadero
            2 => ['font' => ['bold' => true]],
            3 => ['font' => ['bold' => true]],
            4 => ['font' => ['bold' => true]],
            5 => ['font' => ['bold' => true]], // Negrita en encabezados de tabla
        ];
    }

    public function mergedCells()
    {
        return $this->mergeCells;
    } */

    public function view(): View
    {

        $criadero = Criadero::with(['propietario', 'tecnico', 'pastor'])
                            ->find($this->criadero_id);

        $ejemplares = Ejemplar::where('criadero_id', $this->criadero_id)
            ->with(['color', 'fenotipo', 'raza', 'biometrias', 'morfologicos'])
            ->get();
        return view('exports.criadero', [
            'criadero' => $criadero,
            'ejemplares' => $ejemplares,
        ]);
    }
}

