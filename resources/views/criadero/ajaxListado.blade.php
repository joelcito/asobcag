<div style="overflow-x: auto;">
    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <thead>
            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                <th>Nombre</th>
                <th>Propietario</th>
                <th>Tecnico</th>
                <th>Pastor</th>
                <th>Estancia</th>
                <th>localidad</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 fw-semibold">
            @forelse ( $criaderos as $criadero)
                <tr>
                    <td>{{ $criadero->nombre }}</td>
                    <td>{{ optional($criadero->propietario)->name }}</td>
                    <td>{{ optional($criadero->tecnico)->name }}</td>
                    <td>{{ optional($criadero->pastor)->name  }}</td>
                    <td>{{ $criadero->estancia  }}</td>
                    <td>{{ $criadero->localidad_id }}</td>
                    <td>
                        <a class="btn btn-icon btn-sm btn-info btn-circle" title="Detalle criadero" href="{{ route('criadero.detalle', [$criadero->id]) }}" ><i class="fa fa-list-alt"></i></a>
                        <button class="btn btn-icon btn-sm btn-warning btn-circle" title="Editar criadero" onclick="editarCriadero({{ json_encode($criadero) }})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-icon btn-sm btn-danger btn-circle" title="Eliminar criadero" onclick="eliminarCriadero({{ json_encode($criadero) }})"><i class="fa fa-trash"></i></button>
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
