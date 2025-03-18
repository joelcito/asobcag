<div style="overflow-x: auto;">
    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <thead>
            <tr class="text-center text-muted fw-bold fs-7 text-uppercase gs-0">
                <th colspan="3">Ejemplar</th>
                <th rowspan="2">Clasificacion</th>
                <th rowspan="2">Detalle</th>
                <th rowspan="2">Actions</th>
            </tr>
            <tr class="text-center text-muted fw-bold fs-7 text-uppercase gs-0">
                <th>Nombre</th>
                <th>Arete</th>
                <th>Microchip</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 fw-semibold">
            @forelse ( $ferias as $feria)
                <tr>
                    <td>{{ optional($feria->ejemplar)->nombre }}</td>
                    <td>{{ optional($feria->ejemplar)->arete }}</td>
                    <td>{{ optional($feria->ejemplar)->microchip }}</td>
                    <td>{{ $feria->clasificacion }}</td>
                    <td>{{ $feria->detalle }}</td>
                    <td>
                        <button class="btn btn-icon btn-sm btn-dark btn-circle" title="Calificar" onclick="calificarFeriaEjemplar({{ json_encode($feria) }})"><i class="fas fa-clipboard-check"></i></button>
                        <button class="btn btn-icon btn-sm btn-warning btn-circle" title="Editar ferias ejemplar" onclick="editarFeriaEjemplar({{ json_encode($feria) }})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-icon btn-sm btn-danger btn-circle" title="Eliminar ferias ejemplar" onclick="eliminarFeriaEjemplar({{ json_encode($feria) }})"><i class="fa fa-trash"></i></button>
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
