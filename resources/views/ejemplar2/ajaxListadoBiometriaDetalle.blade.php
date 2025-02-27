<div class="table-responsive">
    @if ($ejemplar->tipo === 'LLAMA')
        <table class="table">
            <thead>
                <tr class="fw-bold fs-7 text-gray-800">
                    <th>Evaluador</th>
                    <th>Motivo</th>
                    <th>Fecha</th>
                    <th>Peso</th>
                    <th>Altura Cruz</th>
                    <th>Altura Grupa</th>
                    <th>Altura Cabeza</th>
                    <th>Ancho Pecho</th>
                    <th>Ancho Isquiones</th>
                    <th>Perimetro Toraxico</th>
                    <th>Perimetro Abdominal</th>
                    <th>Largo Cuello</th>
                    <th>Cuello Perimetro Sup.</th>
                    <th>Cuello Perimetro Inf.</th>
                    <th>Largo Oreja</th>
                    <th>Largo Cola</th>
                    <th>Largo Cuerpo</th>
                    <th>Diametro Cania Ant.</th>
                    <th>Diametro Cania Post.</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $biometrias as $bio )
                    <tr class="fs-7">
                        <td>{{ $bio->evaluador->name }}</td>
                        <td>{{ $bio->motivo }}</td>
                        <td>{{ $bio->fecha }}</td>
                        <td>{{ $bio->peso  }}</td>
                        <td>{{ $bio->altura_cruz }}</td>
                        <td>{{ $bio->altura_grupa }}</td>
                        <td>{{ $bio->altura_cabeza }}</td>
                        <td>{{ $bio->ancho_pecho }}</td>
                        <td>{{ $bio->ancho_isquiones }}</td>
                        <td>{{ $bio->perimetro_toraxico }}</td>
                        <td>{{ $bio->perimetro_abdominal }}</td>
                        <td>{{ $bio->largo_cuello }}</td>
                        <td>{{ $bio->cuello_perimetro_sup }}</td>
                        <td>{{ $bio->cuello_perimetro_inf }}</td>
                        <td>{{ $bio->largo_oreja }}</td>
                        <td>{{ $bio->largo_cola }}</td>
                        <td>{{ $bio->largo_cuerpo }}</td>
                        <td>{{ $bio->diametro_cania_ant }}</td>
                        <td>{{ $bio->diametro_cania_post }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif($ejemplar->tipo === 'ALPACA')
        <!--begin::Table-->
        <table class="table">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th>Evaluador</th>
                    <th>Motivo</th>
                    <th>Fecha</th>
                    <th>Peso</th>
                    <th>Talla a la Cruz</th>
                    <th>Talla a la Cabeza</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $biometrias as $bio )
                    <tr>
                        <td>{{ $bio->evaluador->name }}</td>
                        <td>{{ $bio->motivo }}</td>
                        <td>{{ $bio->fecha }}</td>
                        <td>{{ $bio->peso  }}</td>
                        <td>{{ $bio->altura_cruz }}</td>
                        <td>{{ $bio->altura_cabeza }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
