<div style="overflow-x: auto;">
    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_biometria">
        <thead>
            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                <th>Laboratorio</th>
                <th>Equipo</th>
                <th>Fecha Muestreo</th>
                <th>Fecha Analisis</th>
                <th>Zona Corporal</th>
                <th>FD</th>
                <th>SD</th>
                <th>CV</th>
                <th>FC</th>
                <th>PM</th>
                <th>MFD</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 fw-semibold">

            @foreach ( $analisisFibras as $fibra )
                <tr>
                    <td>{{ $fibra->laboratorioRelacion->nombre }}</td>
                    <td>{{ $fibra->equipo->nombre }}</td>
                    <td>{{ $fibra->fecha_muestreo }}</td>
                    <td>{{ $fibra->fecha_analisis  }}</td>
                    <td>{{ $fibra->zona_corporal }}</td>
                    <td>{{ $fibra->fd }}</td>
                    <td>{{ $fibra->sd }}</td>
                    <td>{{ $fibra->cv }}</td>
                    <td>{{ $fibra->fc }}</td>
                    <td>{{ $fibra->pm }}</td>
                    <td>{{ $fibra->mfd }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!--end::Table-->
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-info w-100 btn-sm" onclick="agregarNuevoRegistroFibra()"><i class="fa fa-plus"></i> Nuevo Fibra</button>
        </div>
    </div>
</div>
