@extends('layouts.app')
@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .tamanio_boton{
            font-size: 6px;
        }
    </style>
@endsection
@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')

<!--begin::Modal - Add task-->
<div class="modal fade" id="modalDiagnostico" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE DIAGNOSTICO <span class="text-info" id="nombre_busqueda"></span></h3>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioDiagnostico">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Empadre</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="empadre_nombre" readonly>
                                    <input type="hidden" id="empadre_id" name="empadre_id">
                                    <button class="btn btn-primary" type="button" onclick="mostrarModalBusqueda()">Buscar</button>
                                </div>
                                <div class="text-danger error-message" id="error-empadre_id"></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Metodo</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalDiagnostico"
                                    class="form-select form-select-solid fw-bold" name="metodo_id" id="metodo_id">
                                    <option></option>
                                    @foreach ($metodos as $metodo)
                                        <option value="{{ $metodo->id }}">{{ $metodo->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-metodo_id"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Supervisor</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalDiagnostico"
                                    class="form-select form-select-solid fw-bold" name="supervisor_id" id="supervisor_id">
                                    <option></option>
                                    @foreach ($supervisores as $supervisor)
                                        <option value="{{ $supervisor->id }}">{{ $supervisor->nombres.' '.$supervisor->ap_paterno }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-supervisor_id"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Fecha</label>
                                <input type="date" class="form-control form-control-sm" id="fecha" name="fecha">
                                <div class="text-danger error-message" id="error-fecha"></div>
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Diagnostico</label>
                                <input type="text" class="form-control form-control-sm" id="diagnostico" name="diagnostico">
                                <div class="text-danger error-message" id="error-diagnostico"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm w-100 btn-success" onclick="guardarDiagnostico()">Guardar</button>
                    </div>
                </div>
            </div>
            <!--end::Modal body-->
        </div>
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add task-->
<!-- Modal de Búsqueda -->
<div class="modal fade" id="modalBuscarEmpadre" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="fw-bold">Buscar Empadre</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control mb-3" id="inputBusquedaEmpadre" placeholder="Ingrese al menos 3 letras...">
                <div id="resultadosEmpadre"></div>
            </div>
        </div>
    </div>
</div>

<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxlg">
            <!--begin::Card-->
            <div class="card">
                <div class="card-header flex-wrap bg-light-info py-4">
                    <div id="kt_app_toolbar_container" class="app-container container-xxlg d-flex flex-stack">
                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <!--begin::Title-->
                            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">LISTADO DE DIAGNOSTICOS</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Page title-->

                        <!--begin::Actions-->
                        <div class="d-flex gap-2 gap-lg-3">
                            <a class="btn btn-sm fw-bold btn-primary" onclick="modalNuevoDiagnostico()"><i class="fa fa-plus"></i>Nuevo Diagnostico</a>
                        </div>

                        <!--end::Actions-->
                    </div>
                </div>

                <div class="card-body py-4">
                    <div id="table_listado">

                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->

@stop()

@section('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $.ajaxSetup({
            // definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $(document).ready(function() {
            ajaxListado();
        });

        function ajaxListado(){

            let datos = {};
            $.ajax({
                url: "{{ route('diagnostico.ajaxListado') }}",
                method: "POST",
                data: datos,
                success: function (resultado) {

                    if(resultado.estado){
                        $('#table_listado').html(resultado.data.listado)
                    }else{

                    }
                    // Ocultar SweetAlert2 cuando la solicitud sea exitosa
                    // Swal.close();
                }
            })
        }

        function mostrarModalBusqueda() {
            $('#modalBuscarEmpadre').modal('show');
            $('#inputBusquedaEmpadre').val('').focus();
            $('#resultadosEmpadre').html('');
        }

        $('#inputBusquedaEmpadre').on('input', function () {
            let query = $(this).val();

            if (query.length >= 3) {
                $.ajax({
                    url: "{{ route('diagnostico.buscarEmpadre') }}",
                    method: "POST",
                    data: { query: query },
                    success: function (response) {
                        if (response.estado) {
                            $('#resultadosEmpadre').html(response.html);
                        } else {
                            $('#resultadosEmpadre').html('<p class="text-center text-muted">' + response.mensaje + '</p>');
                        }
                    }
                });
            } else {
                $('#resultadosEmpadre').html('');
            }
        });

        function seleccionarEmpadre(id, nombre, arete) {
            $('#empadre_id').val(id);
            $('#empadre_nombre').val(nombre+' - '+arete);
            $('#modalBuscarEmpadre').modal('hide');
        }

        function limpiarErorres(){
            $('.error-message').html('');
            $('.is-invalid').removeClass('is-invalid');
        }

        function modalNuevoDiagnostico(){
            limpiarErorres();

            $('#id').val(0)
            $('#empadre_id').val('')
            $('#empadre_nombre').val('')
            $('#metodo_id').val(null).trigger('change')
            $('#supervisor_id').val(null).trigger('change')
            $('#fecha').val('')
            $('#diagnostico').val('')
            $('#modalDiagnostico').modal('show')
        }

        function guardarDiagnostico(){
            let datos = $('#formularioDiagnostico').serializeArray();
            $.ajax({
                url: "{{ route('diagnostico.guardarDiagnostico') }}",
                method: "POST",
                data: datos,
                success: function (resultado) {
                    if(resultado.estado){
                        ajaxListado();
                        $('#modalDiagnostico').modal('hide')
                    }else{

                    }
                },
                error: function (xhr) {
                    limpiarErorres();

                    if (xhr.status === 422) { 
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, messages) {
                            let input = $('[name="' + key + '"]');
                            let errorDiv = $('#error-' + key);

                            if (input.length > 0) {
                                input.addClass('is-invalid'); // Agregar clase de error
                                errorDiv.html('<span>' + messages[0] + '</span>'); // Mostrar mensaje
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ocurrió un error inesperado.',
                        });
                    }
                }
            });
        }

        function editarDiagnostico(diagnostico){
            limpiarErorres();

            Object.keys(diagnostico).forEach(key => {
                let input = $(`#${key}`);

                if (input.is(':checkbox')) {
                    // Marcar si el valor es 1, true o "on"
                    input.prop('checked', diagnostico[key] == 1 || diagnostico[key] === true || diagnostico[key] === "on");
                } else if (input.is('select')) {
                    // Para selects con librerías como Select2
                    input.val(diagnostico[key]).trigger('change');
                } else if (input.length) {
                    // Para inputs normales (text, number, email, etc.)
                    input.val(diagnostico[key]);
                }
            });
            $('#empadre_nombre').val(diagnostico.empadre.madre.nombre +' - '+diagnostico.empadre.madre.arete);
            $('#modalDiagnostico').modal('show');
        }

        function eliminarDiagnostico(diagnostico){
            Swal.fire({
                title: "Quieres eliminar ",
                text: "Ya no podras recuperarlo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, borrar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "{{ route('diagnostico.eliminarDiagnostico') }}",
                        method: "POST",
                        data: diagnostico,
                        success: function (resultado) {
                            if(resultado.estado){
                                ajaxListado();
                            }
                        },
                        error: function (xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrió un error inesperado.',
                                
                            });                    
                        }
                    });
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "Cancelado",
                        "La operacion fue cancelada",
                        "error"
                    )
                }
            });
            
        }

   </script>
@endsection
