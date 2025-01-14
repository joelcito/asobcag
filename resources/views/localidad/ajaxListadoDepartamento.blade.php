<div class="card">
    <div class="card-header flex-wrap bg-light-info py-4">
        <div id="kt_app_toolbar_container" class="app-container container-xxlg d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">LISTADO DE DEPARTAMENTOS</h1>
            </div>
            <div class="d-flex gap-2 gap-lg-3">
                <a class="btn btn-sm fw-bold btn-primary" onclick="modalNuevoDepartamento('{{ $pais_id }}')"><i class="fa fa-plus"></i>Nuevo Departamento</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div style="overflow-x: auto;">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>Nombre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @forelse ( $departamentos as $departamento)
                        <tr>
                            <td>{{ $departamento->nombre }}</td>
                            <td>
                                <button class="btn btn-icon btn-sm btn-info btn-circle" title="Editar raza" onclick="ajaxListadoProvincia('{{ $departamento->id }}')"><i class="fa fa-chain"></i></button>
                                <button class="btn btn-icon btn-sm btn-warning btn-circle" title="Editar raza"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-icon btn-sm btn-danger btn-circle" title="Eliminar raza"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <h4 class="text-danger">No hay datos</h4>
                    @endforelse
                </tbody>
            </table>
            <!--end::Table-->
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-dark w-100 btn-sm" onclick="cerrarDepartamento()">Cerrar</button>
    </div>
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
