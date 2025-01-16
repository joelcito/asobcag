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
{{-- <div class="modal fade" id="modalBuscarEjemplar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">BUSQUEDA DE EJEMPLAR <span class="text-info" id="nombre_busqueda"></span></h3>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioRecepcionFacuraContingenciaFueraLineaEentoSignificativo">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Numero Registro</label>
                                <input type="number" class="form-control form-control-sm buscar_ejemplar" id="numero_registro_busqueda" name="numero_registro_busqueda">
                                <input type="hidden" id="sexo_busqueda" name="sexo_busqueda">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Nombre Ejemplar</label>
                                <input type="text" class="form-control form-control-sm buscar_ejemplar" id="nombre_busquedas" name="nombre_busquedas">
                            </div>
                        </div>
                    </div>
                </form>
                <div id="table_ejemplares_buscados">

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
                            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">FORMULARIO DE CAMADA</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Page title-->

                        <!--begin::Actions-->
                        {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
                            <a class="btn btn-sm fw-bold btn-primary" href="{{ url('factura/formularioFacturacionCv') }}"><i class="fa fa-plus"></i>Nueva Venta Compra Venta</a>

                            <a class="btn btn-sm fw-bold btn-primary" href="{{ url('factura/formularioFacturacionTc') }}"><i class="fa fa-plus"></i>Nueva Venta Tasa Cero</a>

                            <a class="btn btn-sm fw-bold btn-primary" href="{{ url('factura/formularioFacturacionSe') }}"><i class="fa fa-plus"></i>Nueva Venta Sector Educativo</a>
                        </div> --}}
                        <!--end::Actions-->
                    </div>
                </div>

                <div class="card-body py-4">
                    <form id="formularioEjemplarCamada">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary btn-sm w-100" onclick="abraModalPadres('PADRE')"><span id="nombre_padre">PADRE</span></button>
                                <input type="hidden" id="padre_id" name="padre_id" >
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-info btn-sm w-100" onclick="abraModalPadres('MADRE')"><span id="nombre_madre">MADRE</span></button>
                                <input type="hidden" id="madre_id" name="madre_id" >
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="fw-semibold fs-6 mb-2 required">Descripcion de la Camada</label>
                                <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2 required">Raza</label>
                                <select class="form-control form-control-sm" name="raza_id" id="raza_id">
                                    @foreach ($razas as $raza)
                                    <option value="{{ $raza->id }}">{{ $raza->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2 required">Propietario</label>
                                <select class="form-control form-control-sm" name="propietario_id" id="propietario_id">
                                    @foreach ($propietarios as $propietario)
                                    <option value="{{ $propietario->id }}">{{ $propietario->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2 required">Cominidad</label>
                                <select class="form-control form-control-sm" name="comunidad_id" id="comunidad_id">
                                    @foreach ($cominidades as $comunidad)
                                    <option value="{{ $comunidad->id }}">{{ $comunidad->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2 required">Fecha Nacimiento</label>
                                <input type="date" class="form-control form-control-sm" name="fecha_nacimiento" id="fecha_nacimiento" required >
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2 required">Numero Parto Padre</label>
                                <input type="text" class="form-control form-control-sm" name="numero_parto_padre" id="numero_parto_padre" required >
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2 required">Numero Parto Madre</label>
                                <input type="text" class="form-control form-control-sm" name="numero_parto_madre" id="numero_parto_madre" required >
                            </div>
                        </div>

                        <!--begin::Example-->
                        <div class="separator separator-content border-dark my-15"><span class="w-250px fw-bold">Registro de Ejemplares</span></div>
                        <!--end::Example-->

                        <!--begin::Repeater-->
                        <div id="kt_docs_repeater_basic" class="mt-5">
                            <!--begin::Form group-->
                            <div class="form-group">
                                <div data-repeater-list="kt_docs_repeater_basic">
                                    <div data-repeater-item>
                                        <!--begin::Example-->
                                        <div class="separator separator-dotted separator-content border-success my-15">
                                            <i class="ki-duotone ki-check-square fs-2 text-success"><span class="path1"></span><span class="path2"></span></i>
                                        </div>
                                        <!--end::Example-->
                                        <div class="form-group row">
                                            <div class="col-md-11">
                                                <div class="row mt-3">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Nombre:</label>
                                                        <input type="email" class="form-control mb-2 mb-md-0 form-control-sm" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Color:</label>
                                                        <input type="email" class="form-control mb-2 mb-md-0 form-control-sm"  />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Sexo:</label>
                                                        <select name="sexo" id="sexo" class="form-control form-control-sm" required>
                                                            <option value="Macho">Macho</option>
                                                            <option value="Hembra">Hembra</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Fecha Registro:</label>
                                                        <input type="date" class="form-control mb-2 mb-md-0 form-control-sm" value="{{ date('Y-m-d') }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Color Tradicional:</label>
                                                        <input type="email" class="form-control mb-2 mb-md-0 form-control-sm" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Numero Arete:</label>
                                                        <input type="email" class="form-control mb-2 mb-md-0 form-control-sm" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Peso Nacimiento:</label>
                                                        <input type="number" class="form-control mb-2 mb-md-0 form-control-sm" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Peso Vivo:</label>
                                                        <input type="number" class="form-control mb-2 mb-md-0 form-control-sm" />
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Perimetro Toracico:</label>
                                                        <input type="number" class="form-control mb-2 mb-md-0 form-control-sm"  />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Altura Cruz:</label>
                                                        <input type="number" class="form-control mb-2 mb-md-0 form-control-sm"  />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Largo Cuerpo:</label>
                                                        <input type="number" class="form-control mb-2 mb-md-0 form-control-sm"  />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Altura Grupa:</label>
                                                        <input type="number" class="form-control mb-2 mb-md-0 form-control-sm"  />
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Ancho Anca:</label>
                                                        <input type="number" class="form-control mb-2 mb-md-0 form-control-sm"  />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Largo Cuello:</label>
                                                        <input type="number" class="form-control mb-2 mb-md-0 form-control-sm"  />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8 w-100">
                                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                    Eliminar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Form group-->

                            <!--begin::Form group-->
                            <div class="form-group mt-5">
                                <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                    <i class="ki-duotone ki-plus fs-3"></i>
                                    Agregar Ejemplar
                                </a>
                            </div>
                            <!--end::Form group-->
                        </div>
                        <!--end::Repeater-->

                    </form>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-success btn-sm w-100" onclick="guardar()">Guardar</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url('ejemplar/listado') }}" type="button" class="btn btn-dark btn-sm w-100">Volver</a>
                        </div>
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
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script>
        $.ajaxSetup({
            // definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $(document).ready(function() {

            let debounceTimer;
            $('.buscar_ejemplar').keyup(function(){
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function() {
                    buscarEjemplar();
                }, 300);
            })

            $('#kt_docs_repeater_basic').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function () {
                    $(this).slideDown();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

        });

        function buscarEjemplar(){
            let datos = {
                numero_registro : $('#numero_registro_busqueda').val(),
                sexo            : $('#sexo_busqueda').val(),
                nombre          : $('#nombre_busquedas').val()
            }
            $.ajax({
                url: "{{ url('ejemplar/buscarEjemplar') }}",
                method: "POST",
                data: datos,
                success: function (resultado) {
                    if(resultado.estado){
                        $('#table_ejemplares_buscados').html(resultado.data.listado)
                    }else{

                    }
                }
            })
        }

        function abraModalPadres(tipo){
            $('#nombre_busqueda').text(tipo)
            let sexo = tipo == 'PADRE' ? 'Macho': 'Hembra'
            $('#sexo_busqueda').val(sexo)
            $('#numero_registro_busqueda').val('')
            $('#nombre_busquedas').val('')
            $('#table_ejemplares_buscados').html('')
            $('#modalBuscarEjemplar').modal('show')
        }

        function guardar(){
            if($("#formularioEjemplar")[0].checkValidity()){
                let datos = $('#formularioEjemplar').serializeArray();
                $.ajax({
                    url: "{{ url('ejemplar/guardar') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){
                            window.location.href = "{{ url('ejemplar/listado') }}";
                        }else{

                        }
                    }
                })
            }else{
                $("#formularioEjemplar")[0].reportValidity();
            }
        }

        function seleccionarEjemplar(ejemplar, sexo, nombre){

            if(sexo == 'Macho'){
                $('#padre_id').val(ejemplar)
                $('#nombre_padre').text(nombre)
            }else{
                $('#madre_id').val(ejemplar)
                $('#nombre_madre').text(nombre)
            }

            $('#modalBuscarEjemplar').modal('hide')

        }

   </script>
@endsection
