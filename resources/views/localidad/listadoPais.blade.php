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
<div class="modal fade" id="modalpais" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE PAIS <span class="text-info" id="nombre_busqueda"></span></h3>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioPais">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Nombre</label>
                                <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-sm w-100 btn-dark" onclick="cerrarmodalpais()">Cancelar</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-sm w-100 btn-success" onclick="guardarPais()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Modal - Add task-->

<!--begin::Modal - Add task-->
<div class="modal fade" id="modalNuevoDepartamento" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE DEPARTAMENTO</h3>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioDepartamento">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Nombre</label>
                                <input type="text" class="form-control form-control-sm" id="nombreDepartamento" name="nombreDepartamento" required>
                                <input type="hidden" name="pais_id_departamento" id="pais_id_departamento" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-sm w-100 btn-dark" onclick="cancelarNuevoDepartamento()">Cancelar</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-sm w-100 btn-success" onclick="guardarDepartamento()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Modal - Add task-->

<!--begin::Modal - Add task-->
<div class="modal fade" id="modalListaDepartamento" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            {{-- <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold"><span id="texto_listado"></span></h3>
            </div> --}}
            <div class="modal-body scroll-y">
                <div id="listado_departamentos">

                </div>
            </div>
            {{-- <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm w-100 btn-success" onclick="guardarPais()">Guardar</button>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<!--end::Modal - Add task-->

<!--begin::Modal - Add task-->
<div class="modal fade" id="modalNuevoProvincia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE PROVINCIA</h3>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioProvincia">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Nombre</label>
                                <input type="text" class="form-control form-control-sm" id="nombreProvincia" name="nombreProvincia" required>
                                <input type="hidden" name="departamento_id_provincia" id="departamento_id_provincia" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-sm w-100 btn-dark" onclick="cancelarNuevoProvincia()">Cancelar</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-sm w-100 btn-success" onclick="guardarProvincia()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Modal - Add task-->

<!--begin::Modal - Add task-->
<div class="modal fade" id="modalListaMunicipios" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            {{-- <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold"><span id="texto_listado"></span></h3>
            </div> --}}
            <div class="modal-body scroll-y">
                <div id="listado_municipio">

                </div>
            </div>
            {{-- <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm w-100 btn-success" onclick="guardarPais()">Guardar</button>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<!--end::Modal - Add task-->

<!--begin::Modal - Add task-->
<div class="modal fade" id="modalNuevoMunicipio" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE MUNICIPIO</h3>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioMunicipio">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Nombre</label>
                                <input type="text" class="form-control form-control-sm" id="nombreMunicipio" name="nombreMunicipio" required>
                                <input type="hidden" name="provincia_id_municipio" id="provincia_id_municipio" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-sm w-100 btn-dark" onclick="cancelarNuevoMunicipio()">Cancelar</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-sm w-100 btn-success" onclick="guardarMunicipio()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Modal - Add task-->

<!--begin::Modal - Add task-->
<div class="modal fade" id="modalListaProvincia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            {{-- <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold"><span id="texto_listado"></span></h3>
            </div> --}}
            <div class="modal-body scroll-y">
                <div id="listado_provincia">

                </div>
            </div>
            {{-- <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm w-100 btn-success" onclick="guardarPais()">Guardar</button>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<!--end::Modal - Add task-->

<!--begin::Modal - Add task-->
<div class="modal fade" id="modalListaComunidad" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            {{-- <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold"><span id="texto_listado"></span></h3>
            </div> --}}
            <div class="modal-body scroll-y">
                <div id="listado_comunidad">

                </div>
            </div>
            {{-- <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm w-100 btn-success" onclick="guardarPais()">Guardar</button>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<!--end::Modal - Add task-->

<!--begin::Modal - Add task-->
<div class="modal fade" id="modalNuevoComunidad" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE MUNICIPIO</h3>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioComunidad">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Nombre</label>
                                <input type="text" class="form-control form-control-sm" id="nombreComunidad" name="nombreComunidad" required>
                                <input type="hidden" name="municipio_id_comunidad" id="municipio_id_comunidad">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-sm w-100 btn-dark btn-block" onclick="cancelarNuevoComunidad()">Cancelar</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-sm w-100 btn-success btn-block" onclick="guardarComunidad()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Modal - Add task-->

<!--begin::Modal - Add task-->
<div class="modal fade" id="modalLocalidad" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            @include("localidad.components.registroLocalidad")
        </div>
    </div>
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
                            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">LISTADO DE PAIS</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Page title-->

                        <!--begin::Actions-->
                        <div class="d-flex gap-2 gap-lg-3">
                            <a class="btn btn-sm fw-bold btn-primary" onclick="modalNuevoRol()"><i class="fa fa-plus"></i>Nuevo Pais</a>
                        </div>

                        <div class="d-flex gap-2 gap-lg-3">
                            <a class="btn btn-sm fw-bold btn-primary" onclick="modalLocalidad()"><i class="fa fa-plus"></i>Registro Localidad</a>
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
                url: "{{ url('localidad/ajaxListadoPais') }}",
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

        function modalNuevoRol(){
            $('#nombre').val('')
            $('#modalpais').modal('show')
        }

        function guardarPais(){
            if($("#formularioPais")[0].checkValidity()){
                let datos = $('#formularioPais').serializeArray();
                $.ajax({
                    url: "{{ url('localidad/guardarPais') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){
                            ajaxListado();
                            $('#modalpais').modal('hide')
                        }else{

                        }
                    }
                })
            }else{
                $("#formularioPais")[0].reportValidity();
            }
        }

        function listaDepartamento(pais){
            let datos = {pais:pais};
            $.ajax({
                url: "{{ url('localidad/ajaxListadoDepartamento') }}",
                method: "POST",
                data: datos,
                success: function (resultado) {
                    if(resultado.estado){

                        $('#listado_departamentos').html(resultado.data.listado)
                        $('#texto_listado').text('LISTADO DE DEPARTAMENTOS')
                        $('#modalListaDepartamento').modal('show')

                    }else{

                    }
                }
            })
        }

        function modalNuevoDepartamento(pais){
            $('#nombreDepartamento').val('')
            $('#pais_id_departamento').val(pais)
            $('#modalListaDepartamento').modal('hide')
            $('#modalNuevoDepartamento').modal('show')
        }

        function guardarDepartamento(){
            if($("#formularioDepartamento")[0].checkValidity()){
                let datos = $('#formularioDepartamento').serializeArray();
                $.ajax({
                    url: "{{ url('localidad/guardarDepartamento') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){
                            let pais_id = $('#pais_id_departamento').val()
                            listaDepartamento(pais_id)
                            $('#modalNuevoDepartamento').modal('hide')
                        }else{

                        }
                    }
                })
            }else{
                $("#formularioDepartamento")[0].reportValidity();
            }
        }

        function ajaxListadoProvincia(departamento){
            let datos = {departamento:departamento};
            $.ajax({
                url: "{{ url('localidad/ajaxListadoProvincia') }}",
                method: "POST",
                data: datos,
                success: function (resultado) {
                    if(resultado.estado){

                        $('#listado_provincia').html(resultado.data.listado)
                        $('#modalListaProvincia').modal('show')
                        $('#modalListaDepartamento').modal('hide')

                    }else{

                    }
                }
            })
        }

        function modalNuevoProvincia(departamento){

            $('#nombreProvincia').val('')
            $('#departamento_id_provincia').val(departamento)
            $('#modalListaProvincia').modal('hide')
            $('#modalNuevoProvincia').modal('show')

        }

        function guardarProvincia(){
            if($("#formularioProvincia")[0].checkValidity()){
                let datos = $('#formularioProvincia').serializeArray();
                $.ajax({
                    url: "{{ url('localidad/guardarProvincia') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){
                            let departamento_id = $('#departamento_id_provincia').val()
                            ajaxListadoProvincia(departamento_id)
                            $('#modalNuevoProvincia').modal('hide')
                        }else{

                        }
                    }
                })
            }else{
                $("#formularioProvincia")[0].reportValidity();
            }
        }

        function ajaxListadoMunicipio(provincia){
            let datos = {provincia:provincia};
            $.ajax({
                url: "{{ url('localidad/ajaxListadoMunicipio') }}",
                method: "POST",
                data: datos,
                success: function (resultado) {
                    if(resultado.estado){

                        $('#listado_municipio').html(resultado.data.listado)
                        $('#modalListaMunicipios').modal('show')
                        $('#modalListaProvincia').modal('hide')

                    }else{

                    }
                }
            })
        }

        function modalNuevoMunicipio(provincia){
            $('#nombreMunicipio').val('')
            $('#provincia_id_municipio').val(provincia)
            $('#modalListaMunicipios').modal('hide')
            $('#modalNuevoMunicipio').modal('show')
        }

        function guardarMunicipio(){
            if($("#formularioMunicipio")[0].checkValidity()){
                let datos = $('#formularioMunicipio').serializeArray();
                $.ajax({
                    url: "{{ url('localidad/guardarMunicipio') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){
                            let provincia_id = $('#provincia_id_municipio').val()
                            ajaxListadoMunicipio(provincia_id)
                            $('#modalNuevoMunicipio').modal('hide')
                        }else{

                        }
                    }
                })
            }else{
                $("#formularioMunicipio")[0].reportValidity();
            }
        }

        function ajaxListadoComunidad(municipio){
            let datos = {municipio:municipio};
            $.ajax({
                url: "{{ url('localidad/ajaxListadoComunidad') }}",
                method: "POST",
                data: datos,
                success: function (resultado) {
                    if(resultado.estado){

                        $('#listado_comunidad').html(resultado.data.listado)
                        $('#modalListaMunicipios').modal('hide')
                        $('#modalListaComunidad').modal('show')

                    }else{

                    }
                }
            })
        }

        function modalNuevoComunidad(municipio){
            $('#nombreComunidad').val('')
            $('#municipio_id_comunidad').val(municipio)
            $('#modalListaComunidad').modal('hide')
            $('#modalNuevoComunidad').modal('show')
        }

        function guardarComunidad(){
            if($("#formularioComunidad")[0].checkValidity()){
                let datos = $('#formularioComunidad').serializeArray();
                $.ajax({
                    url: "{{ url('localidad/guardarComunidad') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){
                            let municipio_id = $('#municipio_id_comunidad').val()
                            ajaxListadoComunidad(municipio_id)
                            $('#modalNuevoComunidad').modal('hide')
                        }else{

                        }
                    }
                })
            }else{
                $("#formularioComunidad")[0].reportValidity();
            }
        }

        function cerrarComunidad(){
            $('#modalListaComunidad').modal('hide');
            $('#modalListaMunicipios').modal('show');
        }

        function cancelarNuevoComunidad(){
            $('#modalNuevoComunidad').modal('hide');
            $('#modalListaComunidad').modal('show');
        }

        function cerrarMunicipio(){
            $('#modalListaMunicipios').modal('hide');
            $('#modalListaProvincia').modal('show');
        }

        function cancelarNuevoMunicipio(){
            $('#modalNuevoMunicipio').modal('hide');
            $('#modalListaMunicipios').modal('show');
        }

        function cancelarNuevoProvincia(){
            $('#modalNuevoProvincia').modal('hide');
            $('#modalListaProvincia').modal('show');
        }

        function cerrarProvincia(){
            $('#modalListaProvincia').modal('hide');
            $('#modalListaDepartamento').modal('show');
        }

        function cancelarNuevoDepartamento(){
            $('#modalNuevoDepartamento').modal('hide');
            $('#modalListaDepartamento').modal('show');
        }

        function cerrarDepartamento(){
            $('#modalListaDepartamento').modal('hide');
        }

        function cerrarmodalpais(){
            $('#modalpais').modal('hide');
        }

        function modalLocalidad(){
            $('#modalLocalidad').modal('show');
        }

   </script>
@endsection
