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
                            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">LISTADO DE EJEMPLARES</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Page title-->

                        <!--begin::Actions-->
                        <div class="d-flex gap-2 gap-lg-3">
                            {{-- <a class="btn btn-sm fw-bold btn-primary" href="{{ route('ejemplar.formulario', [0]) }}"><i class="fa fa-plus"></i>Nuevo Registro</a> --}}
                        </div>
                        <div class="d-flex gap-2 gap-lg-3 mx-3">
                            <a class="btn btn-sm fw-bold btn-primary" href="{{ route('ejemplar.formulario', [$tipo, 0]) }}"><i class="fa fa-plus"></i>Nuevo Ejemplar</a>
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
            //$('criadero_id').select2();
        });

        function ajaxListado(){

            let datos = {tipo: "{{ $tipo }}"};
            $.ajax({
                url: "{{ route('ejemplar.ajaxListado') }}",
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
            $('#car_id').val('')
            $('#microchip').val('')
            $('#nombre').val('')
            $('#arete').val('')
            $('#fenotipo_id').val('')
            $('#color_id').val('')
            $('#sexo').val('')
            $('#fecha_nacimiento').val('')
            $('#fecha_registro').val('')
            $('#criadero_id').val('')
            $('#modalFundador').modal('show')
        }

        function guardarFundador(){
            let datos = $('#formularioFundador').serializeArray();
            $.ajax({
                url: "{{ route('ejemplar.guardarEjemplar') }}",
                method: "POST",
                data: datos,
                success: function (resultado) {
                    if(resultado.estado){
                        ajaxListado();
                        $('#modalFundador').modal('hide')
                    }else{

                    }
                }
            })
        }

   </script>
@endsection
