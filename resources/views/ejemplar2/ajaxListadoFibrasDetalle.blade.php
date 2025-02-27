<div style="table-responsive">
    <!--begin::Table-->
    <table class="table">
        <thead>
            <tr class="fw-bold fs-7 text-gray-800">
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
            </tr>
        </thead>
        <tbody>
            @foreach ( $analisisFibras as $fibra )
                <tr class="fs-7">
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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
