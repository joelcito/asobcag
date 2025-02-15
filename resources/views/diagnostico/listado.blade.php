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
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Empadre ID</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalDiagnostico"
                                    class="form-select form-select-solid fw-bold" name="empadre_id" id="empadre_id">
                                    <option></option>
                                    @foreach ($empadres as $empadre)
                                        <option value="{{ $empadre->id }}">{{ $empadre->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Fecha</label>
                                <input type="date" class="form-control form-control-sm" id="fecha" name="fecha">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Diagnostico</label>
                                <input type="text" class="form-control form-control-sm" id="diagnostico" name="diagnostico">
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
            // Mostrar SweetAlert2 antes de enviar la solicitud
            // Swal.fire({
            //     title: 'Generando Listado...',
            //     text: 'Por favor espera mientras generamos el listado.',
            //     allowOutsideClick: false, // Evitar que se cierre al hacer clic fuera
            //     didOpen: () => {
            //         Swal.showLoading(); // Mostrar el spinner de carga
            //     }
            // });

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

        function modalNuevoDiagnostico(){
            $('#empadre_id').val('')
            $('#metodo_id').val('')
            $('#supervisor_id').val('')
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
                }
            })
        }

   </script>
@endsection
