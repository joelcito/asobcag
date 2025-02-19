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
<div class="modal fade" id="modalCampania" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE CAMPANIA <span class="text-info" id="nombre_busqueda"></span></h3>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioCampania">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Nombre</label>
                                <input type="text" class="form-control form-control-sm" id="nombre" name="nombre">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Actual</label>
                                <input type="text" class="form-control form-control-sm" id="actual" name="actual">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Fecha Inicio</label>
                                <input type="date" class="form-control form-control-sm" id="fecha_ini" name="fecha_ini">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Fecha Fin</label>
                                <input type="date" class="form-control form-control-sm" id="fecha_fin" name="fecha_fin">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm w-100 btn-success" onclick="guardarCampania()">Guardar</button>
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
                            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">LISTADO DE CAMPAÑAS</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Page title-->

                        <!--begin::Actions-->
                        <div class="d-flex gap-2 gap-lg-3">
                            <a class="btn btn-sm fw-bold btn-primary" onclick="modalNuevoCampania()"><i class="fa fa-plus"></i>Nuevo Campania</a>
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
                url: "{{ route('campania.ajaxListado') }}",
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
            $(".invalid-feedback").remove();
            $(".is-invalid").removeClass("is-invalid");
        }

        function modalNuevoCampania(){
            limpiarErorres();
            
            $('#id').val(0)
            $('#nombre').val('')
            $('#actual').val('')
            $('#fecha_ini').val('')
            $('#fecha_fin').val('')
            $('#modalCampania').modal('show')
        }

        function guardarCampania(){
            let datos = $('#formularioCampania').serializeArray();
            $.ajax({
                url: "{{ route('campania.guardarCampania') }}",
                method: "POST",
                data: datos,
                success: function (resultado) {
                    if(resultado.estado){
                        ajaxListado();
                        $('#modalCampania').modal('hide')
                    }else{

                    }
                },
                error: function (xhr) {
                    // Limpiar mensajes previos
                    limpiarErorres();

                    if (xhr.status === 422) { // Código HTTP 422 = Errores de validación
                        let errores = xhr.responseJSON.errors;

                        // Recorrer errores y mostrarlos en los inputs correspondientes
                        for (let campo in errores) {
                            let mensaje = errores[campo][0]; // Obtener primer mensaje de error

                            let input = $(`[name="${campo}"]`);
                            input.addClass("is-invalid"); // Agregar clase de Bootstrap
                            input.after(`<div class="invalid-feedback">${mensaje}</div>`); // Mostrar mensaje
                        }
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

        function editarCampania(campania){
            limpiarErorres();

            Object.keys(campania).forEach(key => {
                let input = $(`#${key}`);
                if (input.length) {
                    input.val(campania[key]);
                }
            });
            $('#modalCampania').modal('show')
        }

        function eliminarCampania(campania){
            Swal.fire({
                title: "Quieres eliminar "+campania.nombre,
                text: "Ya no podras recuperarlo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, borrar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "{{ route('campania.eliminarCampania') }}",
                        method: "POST",
                        data: campania,
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
