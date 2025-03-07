@extends('layouts.app')
@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endsection
@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')

<!--begin::Modal - Add task-->
<div class="modal fade" id="modalCriadero" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE CRIADEROS</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioCriadero">
                    <input type="hidden" name="id" id="id">
                    <!-- Campos ocultos para guardar latitud, longitud y altitud -->
                    <input type="hidden" id="latitud" name="latitud">
                    <input type="hidden" id="longitud" name="longitud">
                    <input type="hidden" id="altitud" name="altitud">
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
                        <div class="col-md-3">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Estancia</label>
                                <input type="text" class="form-control form-control-sm" id="estancia" name="estancia">
                                <div class="text-danger error-message" id="error-estancia"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Propietario</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalCriadero"
                                    class="form-select form-select-solid fw-bold" name="propietario_id" id="propietario_id">
                                    <option></option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->nombres.' '.$usuario->ap_paterno }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-propietario_id"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2">Tecnico</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalCriadero"
                                    class="form-select form-select-solid fw-bold" name="tecnico_id" id="tecnico_id">
                                    <option></option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->nombres.' '.$usuario->ap_paterno }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-tecnico_id"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2">Pastor</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalCriadero"
                                    class="form-select form-select-solid fw-bold" name="pastor_id" id="pastor_id">
                                    <option></option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->nombres.' '.$usuario->ap_paterno }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-pastor_id"></div>
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
                    <div class="row mt-3">
                        <div class="col-md-12">
                            @include("localidad.components.registroLocalidad", ['nameModalPadre' => 'modalCriadero'])
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="fw-semibold fs-6 mb-2">Ubicación del Criadero</label>
                            <div id="map" style="height: 300px; border-radius: 8px;"></div>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm w-100 btn-success" onclick="guardarCriadero()">Guardar</button>
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
                            <a class="btn btn-sm fw-bold btn-primary" onclick="modalNuevoCriadero()"><i class="fa fa-plus"></i>Nuevo Registro</a>
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
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
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

        function limpiarErorres(){
            $('.error-message').html('');
            $('.is-invalid').removeClass('is-invalid');
        }

        function modalNuevoCriadero(){
            limpiarErorres();

            $('#id').val(0)
            $('#latitud').val('')
            $('#longitud').val('')
            $('#altitud').val('')
            $('#nombre').val('')
            $('#nit').val('')
            $('#direccion').val('')
            $('#negocio_fibra').prop('checked', false)
            $('#negocio_carne').prop('checked', false)
            $('#negocio_animal').prop('checked', false)
            $('#estancia').val('')
            $('#propietario_id').val(null).trigger('change')
            $('#tecnico_id').val(null).trigger('change')
            $('#pastor_id').val(null).trigger('change')
            $('#modalCriadero').modal('show')
        }

        function guardarCriadero(){
            let datos = $('#formularioCriadero').serializeArray();
            $.ajax({
                url: "{{ route('criadero.guardarCriadero') }}",
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
                        $('#modalCriadero').modal('hide')
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
            })
        }

        function editarCriadero(criadero){
            limpiarErorres();

            Object.keys(criadero).forEach(key => {
                let input = $(`#${key}`);

                if (input.is(':checkbox')) {
                    // Marcar si el valor es 1, true o "on"
                    input.prop('checked', criadero[key] == 1 || criadero[key] === true || criadero[key] === "on");
                } else if (input.is('select')) {
                    // Para selects con librerías como Select2
                    input.val(criadero[key]).trigger('change');
                } else if (input.length) {
                    // Para inputs normales (text, number, email, etc.)
                    input.val(criadero[key]);
                }
            });

            $('#modalCriadero').modal('show');
        }

        function eliminarCriadero(criadero){
            Swal.fire({
                title: "Quieres eliminar "+criadero.nombre,
                text: "Ya no podras recuperarlo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, borrar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "{{ route('criadero.eliminarCriadero') }}",
                        method: "POST",
                        data: criadero,
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

        document.addEventListener("DOMContentLoaded", function () {
            var map = L.map('map').setView([-16.5004, -68.15], 6); // Coordenadas iniciales (Bolivia)
            // Detectar cuando el modal se abre
            $('#modalCriadero').on('shown.bs.modal', function () {
                setTimeout(() => {
                    map.invalidateSize(); // Refresca el tamaño del mapa cuando el modal se muestra
                }, 300);
            });

            // Agregar capa de mapa base (OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker; // Variable para almacenar el marcador

            // Evento al hacer clic en el mapa
            map.on('click', async function (e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                // Obtener altitud usando la API de Open-Elevation
                var altitud = await obtenerAltitud(lat, lng);

                // Si ya hay un marcador, eliminarlo
                if (marker) map.removeLayer(marker);

                // Agregar nuevo marcador en la posición seleccionada
                marker = L.marker([lat, lng]).addTo(map)
                    .bindPopup(`Lat: ${lat.toFixed(5)}, Lng: ${lng.toFixed(5)}, Alt: ${altitud}m`)
                    .openPopup();

                // Guardar valores en los inputs
                $('#latitud').val(lat);
                $('#longitud').val(lng);
                $('#altitud').val(altitud);
            });

            // Función para obtener altitud
            function obtenerAltitud(lat, lng) {
                const url = `https://api.open-elevation.com/api/v1/lookup?locations=${lat},${lng}`;

                fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.results && data.results.length > 0) {
                        const altitud = data.results[0].elevation;

                        // Asignar la altitud al input correspondiente
                        $('#altitud').val(altitud);

                        console.log("Altitud guardada:", altitud);
                    } else {
                        console.error("No se pudo obtener la altitud.");
                    }
                })
                .catch(error => console.error("Error obteniendo altitud:", error));
            }

        });
   </script>
@endsection
