<table>
    <thead>
    <tr>
        <th style="border: 1px solid black; background-color:cornflowerblue; color:white" width="15" align="center" rowspan="2">Nombre</th>
        <th style="border: 1px solid black; background-color:cornflowerblue; color:white" width="15" align="center" rowspan="2">Sexo</th>
        <th style="border: 1px solid black; background-color:cornflowerblue; color:white" width="15" align="center" rowspan="2">Nro. Registro</th>
        <th style="border: 1px solid black; background-color:cornflowerblue; color:white" width="15" align="center" rowspan="2">Microchip</th>
        <th style="border: 1px solid black; background-color:cornflowerblue; color:white" width="15" align="center" rowspan="2">Arete</th>
        <th style="border: 1px solid black; background-color:cornflowerblue; color:white" width="15" align="center" rowspan="2">Fecha Nac.</th>
        <th style="border: 1px solid black; background-color:cornflowerblue; color:white" width="15" align="center" rowspan="2">Fecha reg.</th>
        <th style="border: 1px solid black; background-color:cornflowerblue; color:white" width="15" align="center" rowspan="2">Color</th>
        <th style="border: 1px solid black; background-color:cornflowerblue; color:white" width="15" align="center" rowspan="2">Fenotipo</th>
        <th style="border: 1px solid black; background-color:cornflowerblue; color:white" width="15" align="center" rowspan="2">Raza</th>
        <th style="border: 1px solid black; background-color:cornflowerblue; color:white" width="15" align="center" colspan="6">Biometrias</th>
        <th style="border: 1px solid black; background-color:cornflowerblue; color:white" width="15" align="center" colspan="6">Morfologias</th>
        <th style="border: 1px solid black; background-color:cornflowerblue; color:white" width="15" align="center" colspan="7">Esquilas</th>
        <th style="border: 1px solid black; background-color:cornflowerblue; color:white" width="15" align="center" colspan="5">Medicaciones</th>
    </tr>
    <tr>
        <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Motivo</th>
        <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Fecha</th>
        <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Peso</th>
        <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Altura Cruz</th>
        <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Altura Grupa</th>
        <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Altura Cabeza</th>
        <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Motivo</th>
        <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Fecha Evaluacion</th>
        <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Oreja</th>
        <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Cuello</th>
        <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Cabeza</th>
        <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Alzada</th>
        <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Fecha</th>
        <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Tipo Esquila</th>
        <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Inca Esquila</th>
        <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Peso Manto</th>
        <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Peso Cuello</th>
        <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Peso Braga</th>
        <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Peso Total</th>
        <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Fecha</th>
        <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Tipo</th>
        <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Dosis</th>
        <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Unidades</th>
        <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Observacion</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ejemplares as $e)
        @php
            $maxFilas = max($e->biometrias->count(), $e->morfologicos->count(), $e->esquilas->count(), $e->medicaciones->count());
            $maxFilas = $maxFilas > 0 ? $maxFilas + 1 : 1;
        @endphp
        <tr>
            <td style="border: 1px solid black;" align="center" rowspan="{{ $maxFilas }}">{{ $e->nombre }}</td>
            <td style="border: 1px solid black;" align="center" rowspan="{{ $maxFilas }}">{{ $e->sexo }}</td>
            <td style="border: 1px solid black;" align="center" rowspan="{{ $maxFilas }}">{{ $e->numero_registro }}</td>
            <td style="border: 1px solid black;" align="center" rowspan="{{ $maxFilas }}">{{ $e->microchip }}</td>
            <td style="border: 1px solid black;" align="center" rowspan="{{ $maxFilas }}">{{ $e->arete }}</td>
            <td style="border: 1px solid black;" align="center" rowspan="{{ $maxFilas }}">{{ $e->fecha_nacimiento }}</td>
            <td style="border: 1px solid black;" align="center" rowspan="{{ $maxFilas }}">{{ $e->fecha_registro }}</td>
            <td style="border: 1px solid black;" align="center" rowspan="{{ $maxFilas }}">{{ optional($e->color)->nombre }}</td>
            <td style="border: 1px solid black;" align="center" rowspan="{{ $maxFilas }}">{{ optional($e->fenotipo)->nombre }}</td>
            <td style="border: 1px solid black;" align="center" rowspan="{{ $maxFilas }}">{{ optional($e->raza)->nombre }}</td>
            <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Motivo</th>
            <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Fecha</th>
            <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Peso</th>
            <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Altura Cruz</th>
            <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Altura Grupa</th>
            <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Altura Cabeza</th>
            <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Motivo</th>
            <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Fecha Evaluacion</th>
            <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Oreja</th>
            <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Cuello</th>
            <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Cabeza</th>
            <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Alzada</th>
            <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Fecha</th>
            <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Tipo Esquila</th>
            <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Inca Esquila</th>
            <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Peso Manto</th>
            <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Peso Cuello</th>
            <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Peso Braga</th>
            <th style="border: 1px solid black; background-color:aqua" width="15" align="center">Peso Total</th>
            <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Fecha</th>
            <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Tipo</th>
            <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Dosis</th>
            <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Unidades</th>
            <th style="border: 1px solid black; background-color:lightblue" width="15" align="center">Observacion</th>
        </tr>
        @if (($maxFilas - 1) > 0)
            @for ($i = 0; $i < $maxFilas; $i++) 
                <tr>
                    @if (isset($e->biometrias[$i]))
                        <td style="border: 1px solid black;" align="center">{{ $e->biometrias[$i]->motivo ?? '' }}</td>
                        <td style="border: 1px solid black;" align="center">{{ $e->biometrias[$i]->fecha ?? '' }}</td>
                        <td style="border: 1px solid black;" align="center">{{ $e->biometrias[$i]->peso ?? '' }}</td>
                        <td style="border: 1px solid black;" align="center">{{ $e->biometrias[$i]->altura_cruz ?? '' }}</td>
                        <td style="border: 1px solid black;" align="center">{{ $e->biometrias[$i]->altura_grupa ?? '' }}</td>
                        <td style="border: 1px solid black;" align="center">{{ $e->biometrias[$i]->altura_cabeza ?? '' }}</td>
                    @else
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>               
                    @endif
                    @if (isset($e->morfologicos[$i]))
                        <td style="border: 1px solid black;" align="center">{{ $e->morfologicos[$i]->motivo ?? '' }}</td>
                        <td style="border: 1px solid black;" align="center">{{ $e->morfologicos[$i]->fecha_evaluacion ?? '' }}</td>
                        <td style="border: 1px solid black;" align="center">{{ $e->morfologicos[$i]->oreja ?? '' }}</td>
                        <td style="border: 1px solid black;" align="center">{{ $e->morfologicos[$i]->cuello ?? '' }}</td>
                        <td style="border: 1px solid black;" align="center">{{ $e->morfologicos[$i]->cabeza ?? '' }}</td>
                        <td style="border: 1px solid black;" align="center">{{ $e->morfologicos[$i]->alzada ?? '' }}</td>                    
                    @else
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>               
                    @endif
                    @if (isset($e->esquilas[$i]))
                        <td style="border: 1px solid black;" align="center">{{ $e->esquilas[$i]->fecha ?? '' }}</td>                  
                        <td style="border: 1px solid black;" align="center">{{ $e->esquilas[$i]->tipo_esquila ?? '' }}</td>                  
                        <td style="border: 1px solid black;" align="center">{{ $e->esquilas[$i]->inca_esquila ?? '' }}</td>                  
                        <td style="border: 1px solid black;" align="center">{{ $e->esquilas[$i]->peso_manto ?? '' }}</td>                  
                        <td style="border: 1px solid black;" align="center">{{ $e->esquilas[$i]->peso_cuello ?? '' }}</td>                  
                        <td style="border: 1px solid black;" align="center">{{ $e->esquilas[$i]->peso_braga ?? '' }}</td>                  
                        <td style="border: 1px solid black;" align="center">{{ $e->esquilas[$i]->peso_total ?? '' }}</td>                  
                    @else
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>               
                        <td style="border: 1px solid black;"></td>               
                    @endif
                    @if (isset($e->medicaciones[$i]))
                        <td style="border: 1px solid black;" align="center">{{ $e->esquilas[$i]->fecha ?? '' }}</td>                 
                        <td style="border: 1px solid black;" align="center">{{ $e->esquilas[$i]->tipo ?? '' }}</td>                 
                        <td style="border: 1px solid black;" align="center">{{ $e->esquilas[$i]->dosis ?? '' }}</td>                 
                        <td style="border: 1px solid black;" align="center">{{ $e->esquilas[$i]->unidades ?? '' }}</td>                 
                        <td style="border: 1px solid black;" align="center">{{ $e->esquilas[$i]->observacion ?? '' }}</td>                 
                    @else
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>               
                    @endif
                    
                </tr>
            @endfor 
        @endif
    @endforeach
    @php
        //dd($maxFilas);
    @endphp
    </tbody>
</table>