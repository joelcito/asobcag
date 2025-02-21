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
<div class="modal fade" id="modalBuscarEjemplar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            @include("ejemplar.components.formularioBusqueda")
            {{-- <div class="modal-header" id="kt_modal_add_user_header">
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

                </div> --}}
            </div>
            {{-- <div class="modal-body">
                <h4>ESt fofoer</h4>
            </div> --}}
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
                            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">FORMULARIO DE EJEMPLAR</h1>
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
                    <form id="formularioEjemplar">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2 required">Nombre</label>
                                <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" required value="{{ $ejemplar != null ? $ejemplar->nombre : null }}">
                                <input type="hidden" name="ejemplar_id" id="ejemplar_id" value="{{ $ejemplar != null ? $ejemplar->id : 0 }}">
                            </div>
                            <div class="col-md-2">
                                <label class="fw-semibold fs-6 mb-2 required">Color</label>
                                <input type="text" class="form-control form-control-sm" name="color" id="color" required value="{{ $ejemplar != null ? $ejemplar->color : null }}">
                            </div>
                            <div class="col-md-2">
                                <label class="fw-semibold fs-6 mb-2 required">Sexo</label>
                                <select name="sexo" id="sexo" class="form-control form-control-sm" required>
                                    <option {{ $ejemplar != null ? (($ejemplar->sexo == 'Macho')? 'selected' : '' ) : '' }} value="Macho">Macho</option>
                                    <option {{ $ejemplar != null ? (($ejemplar->sexo == 'Hembra')? 'selected' : '' ) : '' }} value="Hembra">Hembra</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2 required">Raza</label>
                                <select name="raza_id" id="raza_id" class="form-control form-control-sm" required>
                                    @foreach ($razas as $r)
                                        <option {{ $ejemplar != null ? (($ejemplar->raza_id == $r->id)? 'selected' : '' ) : '' }} value="{{ $r->id }}">{{ $r->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label class="fw-semibold fs-6 mb-2 required">Numero Registro</label>
                                <input type="number" value="{{  $ejemplar != null ? $ejemplar->numero_registro : $numeroRegistroSiguiente }}" readonly class="form-control form-control-sm">
                            </div>
                            <div class="col-md-2">
                                <label class="fw-semibold fs-6 mb-2 required">Fecha Nacimiento</label>
                                <input type="date" class="form-control form-control-sm" name="fecha_nacimiento" id="fecha_nacimiento" required value="{{  $ejemplar != null ? $ejemplar->fecha_nacimiento : null }}">
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2 required">Color Tradicional</label>
                                <input type="text" class="form-control form-control-sm" name="color_tradicional" id="color_tradicional" required value="{{  $ejemplar != null ? $ejemplar->color_tradicional : null }}">
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2 required">Numero Arete</label>
                                <input type="text" class="form-control form-control-sm" name="numero_arete" id="numero_arete" required value="{{  $ejemplar != null ? $ejemplar->numero_arete : null }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2 required">Comunidad</label>
                                <select name="comunidad_id" id="comunidad_id" class="form-control form-control-sm" required>
                                    @foreach ($cominidades as $comunidad)
                                        <option {{ $ejemplar != null ? (($ejemplar->comunidad_id == $comunidad->id)? 'selected' : '' ) : '' }} value="{{ $comunidad->id }}">{{ $comunidad->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2 required">Propietario</label>
                                <select name="propietario_id" id="propietario_id" class="form-control form-control-sm" required>
                                    @foreach ($propietarios as $r)
                                        <option {{ $ejemplar != null ? (($ejemplar->propietario_id == $r->id)? 'selected' : '' ) : '' }} value="{{ $r->id }}">{{ $r->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2 required">Fecha Registro</label>
                                <input type="date" class="form-control form-control-sm" name="fecha_registro" id="fecha_registro" value="{{ $ejemplar != null ? $ejemplar->fecha_registro :  date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary btn-sm w-100" onclick="abraModalPadres('PADRE')"><span id="nombre_padre">{{ $ejemplar != null ? (($ejemplar->padre)? $ejemplar->padre->nombre : 'PADRE' ) : 'PADRE'}}</span></button>
                                <input type="hidden" id="padre_id" name="padre_id" value="{{ $ejemplar != null ? $ejemplar->padre_id : null }}">
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-info btn-sm w-100" onclick="abraModalPadres('MADRE')"><span id="nombre_madre">{{ $ejemplar != null ? (($ejemplar->madre)? $ejemplar->madre->nombre : 'MADRE' ) : 'MADRE'}}</span></button>
                                <input type="hidden" id="madre_id" name="madre_id" value="{{ $ejemplar != null ? $ejemplar->madre_id : null }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label class="fw-semibold fs-6 mb-2 required">Peso Nacimiento</label>
                                <input type="number" class="form-control form-control-sm" name="peso_nacimiento" id="peso_nacimiento" required value="{{ $ejemplar != null ? $ejemplar->peso_nacimiento : null }}">
                            </div>
                            <div class="col-md-3">
                                <label class="fw-semibold fs-6 mb-2 required">Peso Vivo</label>
                                <input type="text" class="form-control form-control-sm" name="peso_vivo" id="peso_vivo" required value="{{ $ejemplar != null ? $ejemplar->peso_vivo : null }}">
                            </div>
                            <div class="col-md-3">
                                <label class="fw-semibold fs-6 mb-2 required">Perimetro Toracico</label>
                                <input type="text" class="form-control form-control-sm" name="perimetro_toracico" id="perimetro_toracico" required value="{{ $ejemplar != null ? $ejemplar->perimetro_toracico : null }}">
                            </div>
                            <div class="col-md-3">
                                <label class="fw-semibold fs-6 mb-2 required">Altura Cruz</label>
                                <input type="text" class="form-control form-control-sm" name="altura_cruz" id="altura_cruz" required value="{{ $ejemplar != null ? $ejemplar->altura_cruz : null }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label class="fw-semibold fs-6 mb-2 required">Altura Grupa</label>
                                <input type="text" class="form-control form-control-sm" name="altura_grupa" id="altura_grupa" required value="{{ $ejemplar != null ? $ejemplar->altura_grupa : null }}">
                            </div>
                            <div class="col-md-3">
                                <label class="fw-semibold fs-6 mb-2 required">Largo Cuerpo</label>
                                <input type="text" class="form-control form-control-sm" name="largo_cuerpo" id="largo_cuerpo" required value="{{ $ejemplar != null ? $ejemplar->largo_cuerpo : null }}">
                            </div>
                            <div class="col-md-3">
                                <label class="fw-semibold fs-6 mb-2 required">Ancho Anca</label>
                                <input type="text" class="form-control form-control-sm" name="ancho_anca" id="ancho_anca" required value="{{ $ejemplar != null ? $ejemplar->ancho_anca : null }}">
                            </div>
                            <div class="col-md-3">
                                <label class="fw-semibold fs-6 mb-2 required">Largo Cuello</label>
                                <input type="text" class="form-control form-control-sm" name="largo_cuello" id="largo_cuello" required value="{{ $ejemplar != null ? $ejemplar->largo_cuello : null }}">
                            </div>
                        </div>
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


        {{-- <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

        function ajaxListado(){

            // Mostrar SweetAlert2 antes de enviar la solicitud
            Swal.fire({
                title: 'Generando Listado...',
                text: 'Por favor espera mientras generamos el listado.',
                allowOutsideClick: false, // Evitar que se cierre al hacer clic fuera
                didOpen: () => {
                    Swal.showLoading(); // Mostrar el spinner de carga
                }
            });

            let datos = $('#formulario-busqueda-factura').serializeArray();
            $.ajax({
                    url: "{{ url('factura/ajaxListadoFacturas') }}",
                    method: "POST",
                    data: datos,
                    success: function (data) {
                        if(data.estado === 'success'){
                            $('#tabla_facturas').html(data.listado)
                        }else{

                        }

                        // Ocultar SweetAlert2 cuando la solicitud sea exitosa
                        Swal.close();

                    }
                })
        }

        function modalAnularFactura(factura){
            $('#factura_id').val(factura)
            $('#modalAnular').modal('show')
        }

        function anularFactura(){
            if($("#formularioAnulaciion")[0].checkValidity()){
                let datos = $('#formularioAnulaciion').serializeArray()
                $.ajax({
                    url: "{{ url('factura/anularFactura') }}",
                    method: "POST",
                    data: datos,
                    success: function (data) {

                        console.log(data);

                        if(data.estado === 'success'){
                            Swal.fire({
                                icon : 'success',
                                title: "EXITO!",
                                text : "SE ANULO CON EXITO",
                            })
                            ajaxListado();
                            $('#modalAnular').modal('hide')
                        }else if(data.estado === 'error'){
                            Swal.fire({
                                icon : 'error',
                                title: data.descripcion.codigoDescripcion,
                                text : JSON.stringify(data.descripcion.mensajesList),
                                // timer:1500
                            })
                            $('#modalAnular').modal('hide')
                        }
                    }
                })

            }else{
                $("#formularioAnulaciion")[0].reportValidity();
            }
        }

        function modalRecepcionFacuraContingenciaFueraLinea(){
            $('#evento_significativo_contingencia_select').val('')
            $('#tablas_facturas_offline').hide('toggle');
            $('#modmodalContingenciaFueraLinea').modal('show')
        }

        function buscarEventosSignificativos(){
            if($("#formularioRecepcionFacuraContingenciaFueraLineaEentoSignificativo")[0].checkValidity()){
                let datos_formulario = $("#formularioRecepcionFacuraContingenciaFueraLineaEentoSignificativo").serializeArray();
                $.ajax({
                    url: "{{ url('eventosignificativo/buscarEventosSignificativos') }}",
                    method: "POST",
                    data: datos_formulario,
                    success: function (data) {
                        $('#evento_significativo_contingencia_select').empty();
                        if(data.estado === "success"){
                            $('#bloque_no_hay_eventos').hide('toggle');

                            var newOption = $('<option>').text("SELECCIONE").val(null);
                            $('#evento_significativo_contingencia_select').append(newOption);

                            $(data.eventos).each(function(index, element) {
                                var optionText = element.fecha_ini_evento+" | "+element.fecha_fin_evento+" | "+element.descripcion;
                                // var optionValue = element.codigoRecepcionEventoSignificativo;
                                var optionValue = element.id;
                                var newOption = $('<option>').text(optionText).val(optionValue);
                                $('#evento_significativo_contingencia_select').append(newOption);
                            });
                        }else{
                            $('#mensaje_contingencia').text(data.msg)
                            $('#bloque_no_hay_eventos').show('toggle');
                        }
                    }
                })
            }else{
                $("#formularioRecepcionFacuraContingenciaFueraLineaEentoSignificativo")[0].reportValidity();
            }
        }

        function muestraTableFacturaPaquete(){
            let valor = $('#evento_significativo_contingencia_select').val();
            $.ajax({
                url: "{{ url('eventosignificativo/muestraTableFacturaPaquete') }}",
                method: "POST",
                data:{
                    fecha: $('#fecha_contingencia').val(),
                    valor: $('#evento_significativo_contingencia_select').val()
                },
                dataType: 'json',
                success: function (data) {
                    if(data.estado === "success"){
                        $('#tablas_facturas_offline').html(data.listado);
                        $('#tablas_facturas_offline').show('toggle');
                    }else{
                    }
                }
            })
        }

        function mandarFacturasPaquete(){

            $('#boton_enviar_paquete').prop('disabled', true);

            let arraye = $('#formularioEnvioPaquete').serializeArray();
            // Agregar un nuevo elemento al array
            arraye.push({ name: 'evento_significativo_id', value: $('#evento_significativo_contingencia_select').val() });
            $.ajax({
                url: "{{ url('eventosignificativo/mandarFacturasPaquete') }}",
                method: "POST",
                data:arraye,
                dataType: 'json',
                success: function (data) {
                    if(data.estado === "success"){
                        ajaxListado();
                        $('#modmodalContingenciaFueraLinea').modal('hide')
                        Swal.fire({
                            icon             : 'success',
                            title            : JSON.stringify(data.msg),
                            showConfirmButton: false,       // No mostrar botón de confirmación
                            // timer            : 2000,        // 5 segundos
                            timerProgressBar : true
                        });
                        $('#boton_enviar_paquete').prop('disabled', false);
                    }else{
                        Swal.fire({
                            icon             : 'error',
                            title            : JSON.stringify(data.msg),
                            showConfirmButton: false,       // No mostrar botón de confirmación
                            // timer            : 2000,        // 5 segundos
                            timerProgressBar : true
                        });
                    }
                }
            })
        }

        function desanularFacturaAnulado(factura){
            Swal.fire({
                title: "Estas seguro de Revertir la Factura anulada?",
                text: "Esta accion no se podra revertir!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, estoy seguro!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('factura/desanularFacturaAnulado') }}",
                        method: "POST",
                        data:{
                            factura:factura
                        },
                        dataType: 'json',
                        success: function (data) {
                            if(data.estado === "success"){
                                ajaxListado();
                                $('#modmodalContingenciaFueraLinea').modal('hide')
                                Swal.fire({
                                    icon             : 'success',
                                    title            : "EXITO",
                                    text             : JSON.stringify(data.msg),
                                    showConfirmButton: false,                      // No mostrar botón de confirmación
                                    // timer            : 2000,        // 5 segundos
                                    timerProgressBar : true
                                });
                            }else{
                                Swal.fire({
                                    icon             : 'error',
                                    text            : JSON.stringify(data.msg),
                                    title            : "ERROR",
                                    showConfirmButton: false,                      // No mostrar botón de confirmación
                                    // timer            : 2000,        // 5 segundos
                                    timerProgressBar : true
                                });
                            }
                        }
                    })

                }
            });
        }

        function reportePDF(){

            let datos = $('#formulario-busqueda-factura').serializeArray();

            // Mostrar SweetAlert2 antes de enviar la solicitud
            Swal.fire({
                title: 'Generando PDF...',
                text: 'Por favor espera mientras generamos el archivo.',
                allowOutsideClick: false, // Evitar que se cierre al hacer clic fuera
                didOpen: () => {
                    Swal.showLoading(); // Mostrar el spinner de carga
                }
            });

            $.ajax({
                url: "{{ url('factura/reportePDF') }}",
                method: "POST",
                data: datos,
                xhrFields: {
                    responseType: 'blob' // Esto le dice a jQuery que espere un archivo binario (PDF)
                },
                success: function (data, status, xhr) {
                    // Ocultar SweetAlert2 cuando la solicitud sea exitosa
                    Swal.close();

                    // Crear un enlace temporal para iniciar la descarga
                    var blob = new Blob([data], { type: 'application/pdf' });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "reporte_facturas.pdf"; // Nombre del archivo
                    link.click();
                },
                error: function (xhr, status, error) {
                    // Mostrar error si algo falla
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo generar el PDF. Inténtalo de nuevo.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    console.error("Error al generar el PDF: ", error);
                }
            });

        }

        function exportarExcel(){
            let datos = $('#formulario-busqueda-factura').serializeArray();

            // Mostrar SweetAlert2 antes de enviar la solicitud
            Swal.fire({
                title: 'Generando Excel...',
                text: 'Por favor espera mientras generamos el archivo.',
                allowOutsideClick: false, // Evitar que se cierre al hacer clic fuera
                didOpen: () => {
                    Swal.showLoading(); // Mostrar el spinner de carga
                }
            });

            $.ajax({
                url: "{{ url('factura/reporteExcel') }}",
                method: "POST",
                data: datos,
                xhrFields: {
                    responseType: 'blob' // Esto le dice a jQuery que espere un archivo binario (PDF)
                },
                success: function (data, status, xhr) {
                    // // Ocultar SweetAlert2 cuando la solicitud sea exitosa
                    Swal.close();

                    // Assume `data` contains the binary response from the server
                    var blob = new Blob([data], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'reporte_facturas.xlsx'; // Nombre del archivo Excel
                    document.body.appendChild(link); // Required for Firefox
                    link.click();
                    document.body.removeChild(link);
                },
                error: function (xhr, status, error) {
                    // Mostrar error si algo falla
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo generar el PDF. Inténtalo de nuevo.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    console.error("Error al generar el PDF: ", error);
                }
            });
        } --}}

   </script>
@endsection
