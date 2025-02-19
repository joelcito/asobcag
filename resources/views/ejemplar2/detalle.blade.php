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
{{-- <div class="modal fade" id="modalClienteProvedor" tabindex="-1" aria-hidden="true">
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
                                <div class="text-danger error-message" id="error-nombre"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fw-semibold fs-6 mb-2">NIT</label>
                                <input type="text" class="form-control form-control-sm" id="nit" name="nit">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fw-semibold fs-6 mb-2">Direccion Fisica</label>
                                <input type="text" class="form-control form-control-sm" id="direccion" name="direccion">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Estancia</label>
                                <input type="text" class="form-control form-control-sm" id="estancia" name="estancia">
                                <div class="text-danger error-message" id="error-estancia"></div>
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
                                <div class="text-danger error-message" id="error-propietario_id"></div>
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
</div> --}}
<!--end::Modal - Add task-->

<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxlg">
            <!--begin::Card-->
            <div class="card">
                <div class="card-body py-4">
                     <!--begin::Details-->
                    <div class="d-flex mb-9">
                        <!--begin: Pic-->
                        <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">

                            <img src="{{ asset('assets/img/llama_1.png') }}" height="110" alt="image">
                            <hr/>
                            <center>
                                <div id="qrcode"></div>
                            </center>

                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between flex-wrap mt-1">
                                <div class="d-flex mr-3">
                                    <h2><span class="text-primary">NOMBRE: </span> {{ $ejemplar->nombre }}</h2>
                                </div>
                            </div>

                            <hr />
                            <!--end::Title-->
                            <!--begin::Content-->
                            <div class="row">
                                <div class="col-md-4">
                                    <h6><span class="text-primary">RAZA: </span>
                                    </h6>
                                </div>

                                <div class="col-md-8">
                                    <h6><span class="text-primary">FENOTIPO: </span> {{ $ejemplar->fenotipo->nombre }}</h6>
                                </div>
                            </div>

                            <hr />

                            <div class="row">
                                <div class="col-md-3">
                                    <h6><span class="text-primary">PADRE: </span>
                                    </h6>
                                </div>

                                <div class="col-md-3">
                                    <h6><span class="text-primary">MADRE: </span>
                                    </h6>
                                </div>

                                <div class="col-md-6">
                                    <h6><span class="text-primary">PROPIETARIO: </span>{{ $ejemplar->criadero->propietario->name }} </h6>
                                </div>
                            </div>

                            <hr />

                            <div class="row">
                                <div class="col-md-3">
                                    <h6><span class="text-primary">SEXO: </span> {{ $ejemplar->sexo }}</h6>
                                </div>

                                <div class="col-md-3">
                                    <h6><span class="text-primary">AFIJO: </span> {{ $ejemplar->criadero->nombre }}</h6>
                                </div>

                                <div class="col-md-3">
                                    <h6><span class="text-primary">COLOR: </span> {{ $ejemplar->color->nombre }}</h6>
                                </div>
                            </div>

                            <!--end::Content-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                    <!--end::Details-->
                    <div class="separator separator-solid"></div>
                    <!--begin::Items-->
                    <div class="d-flex align-items-center flex-wrap mt-8">
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="fa-solid fa-horse-head fa-stack-7x"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm text-primary">NUM. REG.</span>
                                <span class="font-weight-bolder font-size-h5"><span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->numero_registro }}</span>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="icon-xl-3x fas fa-barcode"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm text-primary">MICRO CHIP</span>
                                <span class="font-weight-bolder font-size-h5">
                                    <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->microchip }}</span>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="icon-xl-3x fas fa-democrat"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm text-primary">NUM. ARETE</span>
                                <span class="font-weight-bolder font-size-h5">
                                    <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->arete }}</span>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="icon-xl-3x fas fa-list-alt"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm text-primary">TIPO</span>
                                <span class="font-weight-bolder font-size-h5">
                                    <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->tipo }}</span>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="icon-xl-3x fas fa-calendar-day"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm text-primary">F. NACIMIENTO</span>
                                <span class="font-weight-bolder font-size-h5">
                                    <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->fecha_nacimiento }}</span>
                            </div>
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--begin::Items-->
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
            // ajaxListado();
        });

        // function ajaxListado(){

        //     let datos = {};
        //     $.ajax({
        //         url: "{{ route('criadero.ajaxListado') }}",
        //         method: "POST",
        //         data: datos,
        //         success: function (resultado) {

        //             if(resultado.estado){
        //                 $('#table_listado').html(resultado.data.listado)
        //             }else{

        //             }
        //             // Ocultar SweetAlert2 cuando la solicitud sea exitosa
        //             // Swal.close();
        //         }
        //     })
        // }

        // function modalNuevoClienteProvedor(){
        //     $('.error-message').html('');
        //     $('.is-invalid').removeClass('is-invalid');

        //     $('#nombre').val('')
        //     $('#nit').val('')
        //     $('#direccion').val('')
        //     $('#negocio_fibra').prop('checked', false)
        //     $('#negocio_carne').prop('checked', false)
        //     $('#negocio_animal').prop('checked', false)
        //     $('#estancia').val('')
        //     $('#propietario_id').val(null).trigger('change')
        //     $('#modalClienteProvedor').modal('show')
        // }

        // function guardarClienteProvedor(){
        //     let datos = $('#formularioClienteProvedor').serializeArray();
        //     $.ajax({
        //         url: "{{ route('criadero.guardarCriadero') }}",
        //         method: "POST",
        //         data: datos,
        //         success: function (resultado) {
        //             if(resultado.estado){
        //                 ajaxListado();
        //                 $('#modalClienteProvedor').modal('hide')
        //             }else{

        //             }
        //         },
        //         error: function (xhr) {
        //             $('.error-message').html('');
        //             $('.is-invalid').removeClass('is-invalid');

        //             if (xhr.status === 422) {
        //                 let errors = xhr.responseJSON.errors;
        //                 $.each(errors, function(key, messages) {
        //                     let input = $('[name="' + key + '"]');
        //                     let errorDiv = $('#error-' + key);

        //                     if (input.length > 0) {
        //                         input.addClass('is-invalid'); // Agregar clase de error
        //                         errorDiv.html('<span>' + messages[0] + '</span>'); // Mostrar mensaje
        //                     }
        //                 });
        //             } else {
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Error',
        //                     text: 'Ocurrió un error inesperado.',
        //                 });
        //             }
        //         }
        //     })
        // }

   </script>
@endsection
