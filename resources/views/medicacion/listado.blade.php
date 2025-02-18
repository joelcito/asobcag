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
<div class="modal fade" id="modalMedicacion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE MEDICACION <span class="text-info" id="nombre_busqueda"></span></h3>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioMedicacion">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Ejemplar</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalMedicacion"
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
                                <label class="fs-6 fw-semibold form-label mb-2 required">Producto Veterinario</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalMedicacion"
                                    class="form-select form-select-solid fw-bold" name="producto_veterinario_id" id="producto_veterinario_id">
                                    <option></option>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-producto_veterinario_id"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Responsable</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalMedicacion"
                                    class="form-select form-select-solid fw-bold" name="responsable_id" id="responsable_id">
                                    <option></option>
                                    @foreach ($responsables as $responsable)
                                        <option value="{{ $responsable->id }}">{{ $responsable->nombres.' '.$responsable->ap_paterno }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-responsable_id"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Fecha</label>
                                <input type="date" class="form-control form-control-sm" id="fecha" name="fecha">
                                <div class="text-danger error-message" id="error-fecha"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Tipo</label>
                                <input type="text" class="form-control form-control-sm" id="tipo" name="tipo">
                                <div class="text-danger error-message" id="error-tipo"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Dosis</label>
                                <input type="number" class="form-control form-control-sm" id="dosis" name="dosis">
                                <div class="text-danger error-message" id="error-dosis"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Unidades</label>
                                <input type="text" class="form-control form-control-sm" id="unidades" name="unidades">
                                <div class="text-danger error-message" id="error-unidades"></div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="fv-row mb-7">
                                <label class="fw-semibold fs-6 mb-2">Observacion</label>
                                <input type="text" class="form-control form-control-sm" id="observacion" name="observacion">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm w-100 btn-success" onclick="guardarMedicacion()">Guardar</button>
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
                            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">LISTADO DE MEDICACIONES</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Page title-->

                        <!--begin::Actions-->
                        <div class="d-flex gap-2 gap-lg-3">
                            <a class="btn btn-sm fw-bold btn-primary" onclick="modalNuevoMedicacion()"><i class="fa fa-plus"></i>Nueva Medicacion</a>
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
                url: "{{ route('medicacion.ajaxListado') }}",
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

        function modalNuevoMedicacion(){
            $('.error-message').html('');
            $('.is-invalid').removeClass('is-invalid');

            $('#ejemplar_id').val(null).trigger('change')
            $('#producto_veterinario_id').val(null).trigger('change')
            $('#responsable_id').val(null).trigger('change')
            $('#fecha').val('')
            $('#tipo').val('')
            $('#dosis').val('')
            $('#unidades').val('')
            $('#observacion').val('')
            $('#modalMedicacion').modal('show')
        }

        function guardarMedicacion(){
            let datos = $('#formularioMedicacion').serializeArray();
            $.ajax({
                url: "{{ route('medicacion.guardarMedicacion') }}",
                method: "POST",
                data: datos,
                success: function (resultado) {
                    if(resultado.estado){
                        ajaxListado();
                        $('#modalMedicacion').modal('hide')
                    }else{

                    }
                },
                error: function (xhr) {
                    $('.error-message').html('');
                    $('.is-invalid').removeClass('is-invalid');

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

   </script>
@endsection
