<div style="overflow-x: auto;">
    @if($ejemplar->tipo === 'LLAMA')
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_biometria">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th>Evaluador</th>
                    <th>Motivo</th>
                    <th>Fecha</th>
                    <th>Oreja</th>
                    <th>Cuello</th>
                    <th>Cabeza</th>
                    <th>Alzada</th>
                    <th>Largo Cuerpo</th>
                    <th>Amplitud Pecho</th>
                    <th>Fortaleza</th>
                    <th>Balance</th>
                    <th>Canias</th>
                    <th>Copete</th>
                    <th>Linea Superior</th>
                    <th>Grupa</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">

                @foreach ( $morfologicos as $morfologico )
                    <tr>
                        <td>{{ $morfologico->evaluador->name }}</td>
                        <td>{{ $morfologico->motivo }}</td>
                        <td>{{ $morfologico->fecha_evaluacion }}</td>
                        <td>{{ $morfologico->oreja  }}</td>
                        <td>{{ $morfologico->cuello }}</td>
                        <td>{{ $morfologico->cabeza }}</td>
                        <td>{{ $morfologico->alzada }}</td>
                        <td>{{ $morfologico->largo_cuerpo }}</td>
                        <td>{{ $morfologico->amplitud_pecho }}</td>
                        <td>{{ $morfologico->fortaleza }}</td>
                        <td>{{ $morfologico->balance }}</td>
                        <td>{{ $morfologico->canias }}</td>
                        <td>{{ $morfologico->copete }}</td>
                        <td>{{ $morfologico->linea_superior }}</td>
                        <td>{{ $morfologico->grupa }}</td>
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
                        <th>Cabeza</th>
                        <th>Balance</th>
                        <th>Dencidad</th>
                        <th>Rizo</th>
                        <th>Calce</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">

                    @foreach ( $morfologicos as $morfologico )
                        <tr>
                            <td>{{ $morfologico->evaluador->name }}</td>
                            <td>{{ $morfologico->motivo }}</td>
                            <td>{{ $morfologico->fecha_evaluacion }}</td>
                            <td>{{ $morfologico->cabeza }}</td>
                            <td>{{ $morfologico->balance }}</td>
                            <td>{{ $morfologico->densidad }}</td>
                            <td>{{ $morfologico->rizo }}</td>
                            <td>{{ $morfologico->calce }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!--end::Table-->
    @endif
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-info w-100 btn-sm" onclick="agregarNuevoRegistroMorfologico()"><i class="fa fa-plus"></i> Nuevo Morfologico</button>
        </div>
    </div>
</div>

<script>
    // $(document).ready(function() {
    //         $('#kt_table_biometria').DataTable({
    //             lengthMenu: [10, 25, 50, 100], // Opciones de longitud de página
    //             dom: '<"dt-head row"<"col-md-6"l><"col-md-6"f>><"clear">t<"dt-footer row"<"col-md-5"i><"col-md-7"p>>', // Use dom for basic layout
    //             language: {
    //             paginate: {
    //                 first : 'Primero',
    //                 last : 'Último',
    //                 next : 'Siguiente',
    //                 previous: 'Anterior'
    //             },
    //             search : 'Buscar:',
    //             lengthMenu: 'Mostrar _MENU_ registros por página',
    //             info : 'Mostrando _START_ a _END_ de _TOTAL_ registros',
    //             emptyTable: 'No hay datos disponibles'
    //             },
    //             order:[],
    //             //  searching: true,
    //             responsive: true
    //         });


    //     });
</script>
