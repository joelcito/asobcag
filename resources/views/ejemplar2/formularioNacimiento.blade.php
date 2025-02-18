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
                            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">FORMULARIO DE NACIMIENTO</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Page title-->
                    </div>
                </div>

                <div class="card-body py-4">
                    <form id="formularioNacimiento" action="{{ route('ejemplar.guardarEjemplar') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">ID Car</label>
                                    <input type="text" class="form-control form-control-sm" id="car_id" name="car_id">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">ID Microchip</label>
                                    <input type="text" class="form-control form-control-sm" id="microchip" name="microchip">
                                    <div class="text-danger error-message" id="error-microchip"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Nombre</label>
                                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre">
                                    <div class="text-danger error-message" id="error-nombre"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Arete</label>
                                    <input type="text" class="form-control form-control-sm" id="arete" name="arete">
                                    <div class="text-danger error-message" id="error-arete"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mb-2 required">Fenotipo</label>
                                    <select data-control="select2" data-placeholder="Seleccione"
                                        class="form-select form-select-solid fw-bold" name="fenotipo_id" id="fenotipo_id">
                                        <option></option>
                                        @foreach ($fenotipos as $fenotipo)
                                            <option value={{ $fenotipo->id }}>{{ $fenotipo->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger error-message" id="error-fenotipo_id"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mb-2 required">Color</label>
                                    <select data-control="select2" data-placeholder="Seleccione"
                                        class="form-select form-select-solid fw-bold" name="color_id" id="color_id">
                                        <option></option>
                                        @foreach ($colores as $color)
                                            <option value={{ $color->id }}>{{ $color->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger error-message" id="error-color_id"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Sexo</label>
                                    <select name="sexo" id="sexo" class="form-control form-control-sm" required>
                                        <option></option>
                                        <option value="Macho">Macho</option>
                                        <option value="Hembra">Hembra</option>
                                    </select>
                                    <div class="text-danger error-message" id="error-sexo"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control form-control-sm" id="fecha_nacimiento" name="fecha_nacimiento">
                                    <div class="text-danger error-message" id="error-fecha_nacimiento"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Fecha de Registro</label>
                                    <input type="date" class="form-control form-control-sm" id="fecha_registro" name="fecha_registro">
                                    <div class="text-danger error-message" id="error-fecha_registro"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Criadero</label>
                                <select data-control="select2" data-placeholder="Seleccione"
                                     class="form-select form-select-solid fw-bold" name="criadero_id" id="criadero_id">
                                    <option></option>
                                    @foreach ($criaderos as $criadero)
                                        <option value="{{ $criadero->id }}">{{ $criadero->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-criadero_id"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Padre</label>
                                <select data-control="select2" data-placeholder="Seleccione"
                                     class="form-select form-select-solid fw-bold" name="padre_id" id="padre_id">
                                    <option></option>
                                    @foreach ($machos as $macho)
                                        <option value="{{ $macho->id }}">{{ $macho->arete }} - {{ optional($macho->color)->nombre ?? 'Sin color' }} - {{ optional($macho->fenotipo)->nombre ?? 'Sin fenotipo' }} - {{ $macho->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-padre_id"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Madre</label>
                                <select data-control="select2" data-placeholder="Seleccione"
                                     class="form-select form-select-solid fw-bold" name="madre_id" id="madre_id">
                                    <option></option>
                                    @foreach ($hembras as $hembra)
                                        <option value="{{ $hembra->id }}">{{ $hembra->arete }} - {{ optional($hembra->color)->nombre ?? 'Sin color' }} - {{ optional($hembra->fenotipo)->nombre ?? 'Sin fenotipo' }} - {{ $hembra->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-madre_id"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm w-100 btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
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
            $('#formularioNacimiento').on('submit', function(event) {
                event.preventDefault(); // Evita la recarga del formulario

                let formData = $(this).serialize(); // Captura los datos del formulario

                // Limpiar mensajes de error previos
                $('.error-message').html('');
                $('.is-invalid').removeClass('is-invalid');

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Si todo está bien, redirigir o mostrar mensaje de éxito
                        window.location.href = "{{ route('ejemplar.listado') }}";
                    },
                    error: function(xhr) {
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
                        }
                    }
                });
            });
        });

   </script>
@endsection
