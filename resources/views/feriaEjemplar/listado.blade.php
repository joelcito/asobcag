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
<div class="modal fade" id="modalFeriaEjemplar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE FERIA EJEMPLAR <span class="text-info" id="nombre_busqueda"></span></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioFeriaEjemplar">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Ejemplar</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalFeriaEjemplar"
                                    class="form-select form-select-solid fw-bold" name="ejemplar_id" id="ejemplar_id">
                                    <option></option>
                                    @foreach ($ejemplares as $ejemplar)
                                        <option value="{{ $ejemplar->id }}">{{ $ejemplar->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-ejemplar_id"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Feria</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalFeriaEjemplar"
                                    class="form-select form-select-solid fw-bold" name="feria_id" id="feria_id">
                                    <option></option>
                                    @foreach ($ferias as $feria)
                                        <option value="{{ $feria->id }}">{{ $feria->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-feria_id"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Categoria</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalFeriaEjemplar"
                                    class="form-select form-select-solid fw-bold" name="categoria_feria_id" id="categoria_feria_id">
                                    <option></option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-categoria_feria_id"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Premios</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalFeriaEjemplar"
                                    class="form-select form-select-solid fw-bold" name="premio_id" id="premio_id">
                                    <option></option>
                                    @foreach ($premios as $premio)
                                        <option value="{{ $premio->id }}">{{ $premio->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-premio_id"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Juez Principal</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalFeriaEjemplar"
                                    class="form-select form-select-solid fw-bold" name="juez_principal_id" id="juez_principal_id">
                                    <option></option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-juez_principal_id"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2">Juez Adjunto</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalFeriaEjemplar"
                                    class="form-select form-select-solid fw-bold" name="juez_adjunto_id" id="juez_adjunto_id">
                                    <option></option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-juez_adjunto_id"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm w-100 btn-success" onclick="guardarFeriaEjemplar()">Guardar</button>
                    </div>
                </div>
            </div>
            <!--end::Modal body-->
        </div>
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add task-->

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
                            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">LISTADO DE FERIAS DE EJEMPLARES</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Page title-->

                        <!--begin::Actions-->
                        <div class="d-flex gap-2 gap-lg-3">
                            <a class="btn btn-sm fw-bold btn-primary" onclick="modalNuevoFeriaEjemplar()"><i class="fa fa-plus"></i>Nueva Feria Ejemplar</a>
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
                url: "{{ route('feriaEjemplar.ajaxListado') }}",
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

        function limpiarErorres(){
            $('.error-message').html('');
            $('.is-invalid').removeClass('is-invalid');
        }

        function modalNuevoFeriaEjemplar(){
            limpiarErorres();

            $('#id').val(0)
            $('#ejemplar_id').val(null).trigger('change')
            $('#feria_id').val(null).trigger('change')
            $('#categoria_feria_id').val(null).trigger('change')
            $('#premio_id').val(null).trigger('change')
            $('#juez_principal_id').val(null).trigger('change')
            $('#juez_adjunto_id').val(null).trigger('change')
            $('#modalFeriaEjemplar').modal('show')
        }

        function guardarFeriaEjemplar(){
            let datos = $('#formularioFeriaEjemplar').serializeArray();
            $.ajax({
                url: "{{ route('feriaEjemplar.guardarFeriaEjemplar') }}",
                method: "POST",
                data: datos,
                success: function (resultado) {
                    if(resultado.estado){
                        Swal.fire({
                            title: "EL REGISTRO FUE EXITOSO.",
                            icon: "success",
                            timer: 3000, // Se cierra en 3 segundos
                            showConfirmButton: false
                        });
                        ajaxListado();
                        $('#modalFeriaEjemplar').modal('hide')
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

        function editarFeriaEjemplar(feriaEjemplar){
            limpiarErorres();

            Object.keys(feriaEjemplar).forEach(key => {
                let input = $(`#${key}`);

                if (input.is(':checkbox')) {
                    // Marcar si el valor es 1, true o "on"
                    input.prop('checked', feriaEjemplar[key] == 1 || feriaEjemplar[key] === true || feriaEjemplar[key] === "on");
                } else if (input.is('select')) {
                    // Para selects con librerías como Select2
                    input.val(feriaEjemplar[key]).trigger('change');
                } else if (input.length) {
                    // Para inputs normales (text, number, email, etc.)
                    input.val(feriaEjemplar[key]);
                }
            });

            $('#modalFeriaEjemplar').modal('show');
        }

        function eliminarFeriaEjemplar(feriaEjemplar){
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
                        url: "{{ route('feriaEjemplar.eliminarFeriaEjemplar') }}",
                        method: "POST",
                        data: feriaEjemplar,
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
