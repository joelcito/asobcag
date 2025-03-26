<div style="overflow-x: auto;">
    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <thead>
            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                <th>Campaña</th>
                <th>Padre</th>
                <th>Madre</th>
                <th>fecha</th>
                <th>Tipo Empadre</th>
                <th>Tiempo Cop.</th>
                <th>Observacion</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 fw-semibold">
            @forelse ( $empadres as $empadre)
                <tr>
                    <td>{{ optional($empadre->campania)->nombre }}</td>
                    <td>{{ optional($empadre->madre)->nombre }}</td>
                    <td>{{ optional($empadre->padre)->nombre }}</td>
                    <td>{{ $empadre->fecha }}</td>
                    <td>{{ optional($empadre->tipoEmpadre)->nombre }}</td>
                    <td>{{ $empadre->tiempo_copula }}</td>
                    <td>{{ $empadre->observacion }}</td>
                    <td>
                        @can('admin')
                        <button class="btn btn-icon btn-sm btn-warning btn-circle" title="Editar empadre" onclick="editarEmpadre({{ json_encode($empadre) }})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-icon btn-sm btn-danger btn-circle" title="Eliminar empadre" onclick="eliminarEmpadre({{ json_encode($empadre) }})"><i class="fa fa-trash"></i></button>
                        @endcan
                    </td>
                </tr>
            @empty
                <h4 class="text-danger">No hay datos</h4>
            @endforelse
        </tbody>
    </table>
    <!--end::Table-->
</div>

<script>
    $(document).ready(function() {
            $('#kt_table_users').DataTable({
                lengthMenu: [10, 25, 50, 100], // Opciones de longitud de página
                dom: '<"dt-head row"<"col-md-6"l><"col-md-6"f>><"clear">t<"dt-footer row"<"col-md-5"i><"col-md-7"p>>', // Use dom for basic layout
                language: {
                paginate: {
                    first : 'Primero',
                    last : 'Último',
                    next : 'Siguiente',
                    previous: 'Anterior'
                },
                search : 'Buscar:',
                lengthMenu: 'Mostrar _MENU_ registros por página',
                info : 'Mostrando _START_ a _END_ de _TOTAL_ registros',
                emptyTable: 'No hay datos disponibles'
                },
                order:[],
                //  searching: true,
                responsive: true
            });


        });
</script>
