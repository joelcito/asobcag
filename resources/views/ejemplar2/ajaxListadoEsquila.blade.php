<div style="overflow-x: auto;">
    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_biometria">
        <thead>
            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                <th>Esquilador</th>
                <th>Fecha</th>
                <th>Tipo de Esquila</th>
                <th>Inca Esquila</th>
                <th>Peso Manto</th>
                <th>Peso Cuello</th>
                <th>Peso Braga</th>
                <th>Peso Total</th>
                <th>Longitud</th>
                <th>Observacion</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 fw-semibold">

            @foreach ( $esquilas as $esquila )
                <tr>
                    <td>{{ $esquila->esquilador->name }}</td>
                    <td>{{ $esquila->fecha }}</td>
                    <td>{{ $esquila->tipo_esquila }}</td>
                    <td>{{ $esquila->inca_esquila  }}</td>
                    <td>{{ $esquila->peso_manto }}</td>
                    <td>{{ $esquila->peso_cuello }}</td>
                    <td>{{ $esquila->peso_braga }}</td>
                    <td>{{ $esquila->peso_total }}</td>
                    <td>{{ $esquila->longitud }}</td>
                    <td>{{ $esquila->observacion }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!--end::Table-->
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-info w-100 btn-sm" onclick="agregarNuevoRegistroEsquila()"><i class="fa fa-plus"></i> Nuevo Esquila</button>
        </div>
    </div>
</div>
