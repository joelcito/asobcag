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

    public function view(): View
    {

        $criadero = Criadero::with(['propietario', 'tecnico', 'pastor'])
                            ->find($this->criadero_id);

        $ejemplares = Ejemplar::where('criadero_id', $this->criadero_id)
            ->with(['color', 'fenotipo', 'raza', 'biometrias', 'morfologicos', 'esquilas', 'medicaciones'])
            ->get();
        return view('exports.criadero', [
            'criadero' => $criadero,
            'ejemplares' => $ejemplares,
        ]);
    }
}

