<div style="table-responsive">
    @if($ejemplar->tipo === 'LLAMA')
        <!--begin::Table-->
        <table class="table">
            <thead>
                <tr class="fw-bold fs-7 text-gray-800">
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
                </tr>
            </thead>
            <tbody>
                @foreach ( $morfologicos as $morfologico )
                    <tr class="fs-7">
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
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!--end::Table-->
    @elseif($ejemplar->tipo === 'ALPACA')
            <!--begin::Table-->
            <table class="table">
                <thead>
                    <tr class="fw-bold fs-7 text-gray-800">
                        <th>Evaluador</th>
                        <th>Motivo</th>
                        <th>Fecha</th>
                        <th>Cabeza</th>
                        <th>Balance</th>
                        <th>Dencidad</th>
                        <th>Rizo</th>
                        <th>Calce</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $morfologicos as $morfologico )
                        <tr class="fs-7">
                            <td>{{ $morfologico->evaluador->name }}</td>
                            <td>{{ $morfologico->motivo }}</td>
                            <td>{{ $morfologico->fecha_evaluacion }}</td>
                            <td>{{ $morfologico->cabeza }}</td>
                            <td>{{ $morfologico->balance }}</td>
                            <td>{{ $morfologico->densidad }}</td>
                            <td>{{ $morfologico->rizo }}</td>
                            <td>{{ $morfologico->calce }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!--end::Table-->
    @endif
</div>
