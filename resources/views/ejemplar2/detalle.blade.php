@extends('layouts.app')
@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/jquery.orgchart.css') }}" rel="stylesheet" type="text/css" />
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
                            {{-- <center>
                                <div id="qrcode"></div>
                            </center> --}}

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
                                <i class="fa-solid fa-horse-head" style="font-size: 30px; margin-right: 5px;"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm text-primary">NUM. REG.</span>
                                <h5>{{ $ejemplar->numero_registro }}</h5>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span>
                                <i class="fas fa-barcode"  style="font-size: 30px; margin-right: 5px;"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm text-primary">MICRO CHIP</span>
                                <h5>{{ $ejemplar->microchip }}</h5>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="fas fa-democrat"  style="font-size: 30px; margin-right: 5px;"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm text-primary">NUM. ARETE</span>
                                <h5>{{ $ejemplar->arete }}</h5>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="fas fa-list-alt" style="font-size: 30px; margin-right: 5px;"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm text-primary">TIPO</span>
                                <h5>{{ $ejemplar->tipo }}</h5>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="fas fa-calendar-day" style="font-size: 30px; margin-right: 5px;"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm text-primary">F. NACIMIENTO</span>
                                <h5>{{ $ejemplar->fecha_nacimiento }}</h5>
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
<hr>
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxlg">
            <!--begin::Card-->
            <div class="card">
                <div class="card-header flex-wrap bg-light py-4">
                    <div id="kt_app_toolbar_container" class="app-container container-xxlg d-flex flex-stack">
                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <!--begin::Title-->
                            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">GENERACIONES DEL EJEMPLAR</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Page title-->
                    </div>
                </div>
                <div class="card-body py-4">
                    <div id="chart-container"></div>
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
    <script src="{{ asset('assets/js/jquery.orgchart.js') }}"></script>
    <script>
        $.ajaxSetup({
            // definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $(document).ready(function() {

            var datascource = {
                                'id': '1',
                                'name': 'Lao Lao',
                                'title': 'General Manager',
                                'img': '{{ asset("storage/imagenes/ALPACA/1740423400_5uZUrINwv3_9b7187b3-92c6-4de7-8d0b-9ab94d8f811e-original.jpeg") }}',
                                'children': [
                                    {
                                    'id': '2',
                                    'name': 'Bo Miao',
                                    'title': 'Department Manager',
                                    'img': '{{ asset("storage/imagenes/ALPACA/1740423400_5uZUrINwv3_9b7187b3-92c6-4de7-8d0b-9ab94d8f811e-original.jpeg") }}',
                                    'children': [
                                        {
                                        'id': '20',
                                        'name': 'Tie Hua  NUEVO DE JOEL',
                                        'title': 'Senior Engineer',
                                        'img': '{{ asset("storage/imagenes/ALPACA/1740423400_5uZUrINwv3_9b7187b3-92c6-4de7-8d0b-9ab94d8f811e-original.jpeg") }}'
                                        }
                                    ]
                                    },
                                    {
                                    'id': '3',
                                    'name': 'Su Miao',
                                    'title': 'Department Manager',
                                    'img': '{{ asset("storage/imagenes/ALPACA/1740423400_5uZUrINwv3_9b7187b3-92c6-4de7-8d0b-9ab94d8f811e-original.jpeg") }}',
                                    'children': [
                                        {
                                        'id': '4',
                                        'name': 'Tie Hua',
                                        'title': 'Senior Engineer',
                                        'img': '{{ asset("storage/imagenes/ALPACA/1740423400_5uZUrINwv3_9b7187b3-92c6-4de7-8d0b-9ab94d8f811e-original.jpeg") }}'
                                        },
                                        {
                                        'id': '5',
                                        'name': 'Hei Hei',
                                        'title': 'Senior Engineer',
                                        'img': '{{ asset("storage/imagenes/ALPACA/1740423400_5uZUrINwv3_9b7187b3-92c6-4de7-8d0b-9ab94d8f811e-original.jpeg") }}',
                                        'children': [
                                            {
                                            'id': '6',
                                            'name': 'Pang Pang',
                                            'title': 'Engineer',
                                            'img': '{{ asset("storage/imagenes/ALPACA/1740423400_5uZUrINwv3_9b7187b3-92c6-4de7-8d0b-9ab94d8f811e-original.jpeg") }}'
                                            },
                                            {
                                            'id': '7',
                                            'name': 'Xiang Xiang',
                                            'title': 'UE Engineer',
                                            'img': '{{ asset("storage/imagenes/ALPACA/1740423400_5uZUrINwv3_9b7187b3-92c6-4de7-8d0b-9ab94d8f811e-original.jpeg") }}'
                                            }
                                        ]
                                        }
                                    ]
                                    }
                                ]
                            };

            $('#chart-container').orgchart({
                'exportButton': true,
                'exportFilename': 'MyOrgChart',
                'data' : datascource,
                'nodeContent': 'title',
                'nodeID': 'id',
                'createNode': function($node, data) {
                    let imageUrl = data.img ? data.img : 'https://via.placeholder.com/100'; // Si no tiene imagen, usa un placeholder
                    $node.prepend(`<img class="avatar" src="${imageUrl}" style="width: 50px; height: 50px; border-radius: 50%;" crossorigin="anonymous" />`);
                }
            });



        });

   </script>
@endsection
