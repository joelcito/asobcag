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
<div class="modal fade" id="modalClienteProvedor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE CRIADEROS</h3>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioClienteProvedor">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Nombre/Razon</label>
                                <input type="text" class="form-control form-control-sm" id="nombre" name="nombre">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">DNI/RUC</label>
                                <input type="text" class="form-control form-control-sm" id="dni" name="dni">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Direccion Fisica</label>
                                <input type="text" class="form-control form-control-sm" id="direccion" name="direccion">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Estancia</label>
                                <input type="text" class="form-control form-control-sm" id="estancia" name="estancia">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Propietario</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalClienteProvedor"
                                    class="form-select form-select-solid fw-bold" name="propietario_id" id="propietario_id">
                                    <option></option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->nombres.' '.$usuario->ap_paterno }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input h-15px w-15px" type="checkbox" id="negocio_fibra" name="negocio_fibra"/>
                                <label class="form-check-label" for="negocio_fibra">
                                    Negocio de Fibra
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input h-15px w-15px" type="checkbox" id="negocio_carne" name="negocio_carne"/>
                                <label class="form-check-label" for="negocio_carne">
                                    Negocio de Carne
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input h-15px w-15px" type="checkbox" id="negocio_animal" name="negocio_animal"/>
                                <label class="form-check-label" for="negocio_animal">
                                    Negocio de Animal
                                </label>
                            </div>
                        </div>
                    </div>                    
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm w-100 btn-success" onclick="guardarClienteProvedor()">Guardar</button>
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
    <!--begin::Toolbar-->
    {{-- <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxlg d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Listado de Facturas</h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->

            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a class="btn btn-sm fw-bold btn-primary" href="{{ url('factura/formularioFacturacionCv') }}"><i class="fa fa-plus"></i>Nueva Venta Compra Venta</a>

                <a class="btn btn-sm fw-bold btn-primary" href="{{ url('factura/formularioFacturacionTc') }}"><i class="fa fa-plus"></i>Nueva Venta Tasa Cero</a>

                <a class="btn btn-sm fw-bold btn-primary" href="{{ url('factura/formularioFacturacionSe') }}"><i class="fa fa-plus"></i>Nueva Venta Sector Educativo</a>
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div> --}}
    <!--end::Toolbar-->
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
                            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">LISTADO DE CRIADEROS</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Page title-->

                        <!--begin::Actions-->
                        <div class="d-flex gap-2 gap-lg-3">
                            <a class="btn btn-sm fw-bold btn-primary" onclick="modalNuevoClienteProvedor()"><i class="fa fa-plus"></i>Nuevo Registro</a>
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
                url: "{{ route('criadero.ajaxListado') }}",
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

        function modalNuevoClienteProvedor(){
            $('#nombre').val('')
            $('#dni').val('')
            $('#direccion').val('')
            $('#negocio_fibra').prop('checked', false)
            $('#negocio_carne').prop('checked', false)
            $('#negocio_animal').prop('checked', false)
            $('#estancia').val('')
            $('#propietario_id').val(null).trigger('change')
            $('#modalClienteProvedor').modal('show')
        }

        function guardarClienteProvedor(){
            let datos = $('#formularioClienteProvedor').serializeArray();
            $.ajax({
                url: "{{ route('criadero.guardarCriadero') }}",
                method: "POST",
                data: datos,
                success: function (resultado) {
                    if(resultado.estado){
                        ajaxListado();
                        $('#modalClienteProvedor').modal('hide')
                    }else{

                    }
                }
            })
        }

   </script>
@endsection
