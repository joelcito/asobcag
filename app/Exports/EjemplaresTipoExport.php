<?php

namespace App\Exports;

use App\Models\Ejemplar;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMergedCells;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\View\View;

class EjemplaresTipoExport implements /* FromArray, WithHeadings, WithStyles, ShouldAutoSize */ FromView
{
    protected $tipo;
    protected $mergeCells = [];

    public function __construct($tipo)
    {
        $this->tipo = $tipo;
    }
    
    public function view(): View
    {
        $ejemplares = Ejemplar::where('tipo', $this->tipo)
            ->with(['color', 'fenotipo', 'raza', 'biometrias', 'morfologicos', 'esquilas', 'medicaciones'])
            ->get();

        return view('exports.ejemplares', [
            'ejemplares' => $ejemplares,
        ]);
    }
}

