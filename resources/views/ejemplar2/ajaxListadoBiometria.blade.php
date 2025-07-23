<div style="overflow-x: auto;">
    @if ($ejemplar->tipo === 'LLAMA')
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_biometria">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
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
                    {{-- <th>Largo Cuerpo</th> --}}
                    <th>Diametro Cania Ant.</th>
                    <th>Diametro Cania Post.</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">

                @foreach ( $biometrias as $bio )
                    <tr>
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
                        {{-- <td>{{ $bio->largo_cuerpo }}</td> --}}
                        <td>{{ $bio->diametro_cania_ant }}</td>
                        <td>{{ $bio->diametro_cania_post }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!--end::Table-->
    @elseif($ejemplar->tipo === 'ALPACA')
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_biometria">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th>Evaluador</th>
                    <th>Motivo</th>
                    <th>Fecha</th>
                    <th>Peso</th>
                    <th>Talla a la Cruz</th>
                    <th>Talla a la Cabeza</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">

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
        <!--end::Table-->
    @endif
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-info w-100 btn-sm" onclick="agregarNuevoRegistroBiometrico()"><i class="fa fa-plus"></i> Nuevo Biometria</button>
        </div>
    </div>
</div>
