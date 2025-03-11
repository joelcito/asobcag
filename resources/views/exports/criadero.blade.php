<table>
    <thead>
    <tr>
        <th width="15" align="center">CRIADERO</th>
        <th width="15" align="center">Propietario</th>
        <th width="15" align="center">Técnico</th>
        <th width="15" align="center">Pastor</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td width="15" align="center">{{ $criadero->nombre }}</td>
            <td width="15" align="center">{{ optional($criadero->propietario)->name }}</td>
            <td width="15" align="center">{{ optional($criadero->tecnico)->name }}</td>
            <td width="15" align="center">{{ optional($criadero->pastor)->name }}</td>
        </tr>
    </tbody>
</table>
<table>
    <thead>
    <tr>
        <th width="15" align="center" rowspan="2">Nombre</th>
        <th width="15" align="center" rowspan="2">Sexo</th>
        <th width="15" align="center" rowspan="2">Nro. Registro</th>
        <th width="15" align="center" rowspan="2">Microchip</th>
        <th width="15" align="center" rowspan="2">Arete</th>
        <th width="15" align="center" rowspan="2">Fecha Nac.</th>
        <th width="15" align="center" rowspan="2">Fecha reg.</th>
        <th width="15" align="center" rowspan="2">Color</th>
        <th width="15" align="center" rowspan="2">Fenotipo</th>
        <th width="15" align="center" rowspan="2">Raza</th>
        <th width="15" align="center" colspan="6">Biometrias</th>
        <th width="15" align="center" colspan="6">Morfologia</th>
    </tr>
    <tr>
        <th width="15" align="center">Motivo</th>
        <th width="15" align="center">Fecha</th>
        <th width="15" align="center">Peso</th>
        <th width="15" align="center">Altura Cruz</th>
        <th width="15" align="center">Altura Grupa</th>
        <th width="15" align="center">Altura Cabeza</th>
        <th width="15" align="center">Motivo</th>
        <th width="15" align="center">FechaEvaluacion</th>
        <th width="15" align="center">Oreja</th>
        <th width="15" align="center">Cuello</th>
        <th width="15" align="center">Cabeza</th>
        <th width="15" align="center">Alzada</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ejemplares as $e)
        @php
            $maxFilas = max($e->biometrias->count(), $e->morfologicos->count());
            $maxFilas = $maxFilas > 0 ? $maxFilas + 1 : 1;
        @endphp
        <tr>
            <td align="center" rowspan="{{ $maxFilas }}">{{ $e->nombre }}</td>
            <td align="center" rowspan="{{ $maxFilas }}">{{ $e->sexo }}</td>
            <td align="center" rowspan="{{ $maxFilas }}">{{ $e->numero_registro }}</td>
            <td align="center" rowspan="{{ $maxFilas }}">{{ $e->microchip }}</td>
            <td align="center" rowspan="{{ $maxFilas }}">{{ $e->arete }}</td>
            <td align="center" rowspan="{{ $maxFilas }}">{{ $e->fecha_nacimiento }}</td>
            <td align="center" rowspan="{{ $maxFilas }}">{{ $e->fecha_registro }}</td>
            <td align="center" rowspan="{{ $maxFilas }}">{{ optional($e->color)->nombre }}</td>
            <td align="center" rowspan="{{ $maxFilas }}">{{ optional($e->fenotipo)->nombre }}</td>
            <td align="center" rowspan="{{ $maxFilas }}">{{ optional($e->raza)->nombre }}</td>
        </tr>
        @for ($i = 0; $i < $maxFilas; $i++) 
            <tr>
                @if (isset($e->biometrias[$i]))
                    <td align="center">{{ $e->biometrias[$i]->motivo }}</td>
                    <td align="center">{{ $e->biometrias[$i]->fecha }}</td>
                    <td align="center">{{ $e->biometrias[$i]->peso }}</td>
                    <td align="center">{{ $e->biometrias[$i]->altura_cruz }}</td>
                    <td align="center">{{ $e->biometrias[$i]->altura_grupa }}</td>
                    <td align="center">{{ $e->biometrias[$i]->altura_cabeza }}</td>
                @else
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>               
                @endif
                @if (isset($e->morfologicos[$i]))
                    <td align="center">{{ $e->morfologicos[$i]->motivo }}</td>
                    <td align="center">{{ $e->morfologicos[$i]->fecha_evaluacion }}</td>
                    <td align="center">{{ $e->morfologicos[$i]->oreja }}</td>
                    <td align="center">{{ $e->morfologicos[$i]->cuello }}</td>
                    <td align="center">{{ $e->morfologicos[$i]->cabeza }}</td>
                    <td align="center">{{ $e->morfologicos[$i]->alzada }}</td>                    
                @endif
                
            </tr>
        @endfor
    @endforeach
    @php
        //dd($maxFilas);
    @endphp
    </tbody>
</table>