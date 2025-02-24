<div style="overflow-x: auto;">
    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <thead>
            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                <th>Ejemplar</th>
                <th>Producto Veterinario</th>
                <th>Respondable</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Dosis</th>
                <th>Unidades</th>
                <th>Observacion</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 fw-semibold">
            @foreach ( $medicaciones as $medicacion)
                <tr>
                    <td>{{ optional($medicacion->ejemplar)->nombre }}</td>
                    <td>{{ optional($medicacion->productoVeterinario)->nombre }}</td>
                    <td>{{ optional($medicacion->responsable)->name }}</td>
                    <td>{{ $medicacion->fecha }}</td>
                    <td>{{ $medicacion->tipo }}</td>
                    <td>{{ $medicacion->dosis }}</td>
                    <td>{{ $medicacion->unidades }}</td>
                    <td>{{ $medicacion->observacion }}</td>
                    <td>
                        {{-- <button class="btn btn-icon btn-sm btn-warning btn-circle" title="Editar raza" onclick="editarMedicacion({{ json_encode($medicacion) }})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-icon btn-sm btn-danger btn-circle" title="Eliminar raza" onclick="eliminarMedicacion({{ json_encode($medicacion) }})"><i class="fa fa-trash"></i></button> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!--end::Table-->
    <div class="row">
        <div class="col-md-12">
            <button type="button" onclick="agregarNuevoMedicacion()" class="btn btn-sm w-100 btn-info"><i class="fa fa-plus"></i> Nuevo Diagnostico</button>
        </div>
    </div>
</div>

<script>
    // $(document).ready(function() {
    //         $('#kt_table_users').DataTable({
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
