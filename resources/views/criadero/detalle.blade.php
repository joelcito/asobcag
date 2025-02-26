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
@php
    //dd($criadero);
@endphp
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
                            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">DETALLE DE CRIADERO "{{ optional($criadero)->nombre }}"</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Page title-->
                    </div>
                </div>

                <div class="card-body py-4">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ route('criadero.exportEjemplares', [$criadero->id]) }}" class="btn btn-success">
                                Exportar a Excel
                            </a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        {{-- AQUI VAN LOS CHARTS --}}
                        <div class="col-md-4">
                            <div id="chartGenero" style="width:100%; height:400px;"></div>
                            {{-- <button class="btn btn-primary mt-2" onclick="descargarGrafico('genero')">Descargar</button> --}}
                        </div>
                        <div class="col-md-4">
                            <div id="chartColor" style="width:100%; height:400px;"></div>
                            {{-- <button class="btn btn-primary mt-2" onclick="descargarGrafico('color')">Descargar</button> --}}
                        </div>
                        <div class="col-md-4">
                            <div id="chartEdad" style="width:100%; height:400px;"></div>
                            {{-- <button class="btn btn-primary mt-2" onclick="descargarGrafico('edad')">Descargar</button> --}}
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
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            google.charts.load('current', {packages: ['corechart']});
            google.charts.setOnLoadCallback(dibujarGraficos);

            // Redibujar el gráfico cuando se cambia el tamaño de la ventana
            $(window).resize(function() {
                dibujarGraficos();
            });
        });

        let chartGenero, chartColor, chartEdad;

        function dibujarGraficos() {
            // Datos de género (Machos y Hembras)
            var datosGenero = google.visualization.arrayToDataTable([
                ['Sexo', 'Cantidad'],
                @foreach($genero as $g)
                    ['{{ $g->sexo }}', {{ $g->cantidad }}],
                @endforeach
            ]);

            var opcionesGenero = { title: 'Distribución por Género' };
            chartGenero = new google.visualization.PieChart(document.getElementById('chartGenero'));
            chartGenero.draw(datosGenero, opcionesGenero);

            // Datos por color
            var datosColor = google.visualization.arrayToDataTable([
                ['Color', 'Cantidad'],
                @foreach($colores as $c)
                    ['{{ $c->color }}', {{ $c->cantidad }}],
                @endforeach
            ]);

            var opcionesColor = { title: 'Distribución por Color' };
            chartColor = new google.visualization.PieChart(document.getElementById('chartColor'));
            chartColor.draw(datosColor, opcionesColor);

            // Datos por edad
            var datosEdad = google.visualization.arrayToDataTable([
                ['Rango de Edad', 'Cantidad'],
                @foreach($edades as $e)
                    ['{{ $e->rango_edad }}', {{ $e->cantidad }}],
                @endforeach
            ]);

            var opcionesEdad = { title: 'Distribución por Edad' };
            chartEdad = new google.visualization.PieChart(document.getElementById('chartEdad'));
            chartEdad.draw(datosEdad, opcionesEdad);
        }

        // Función para descargar gráficos
        function descargarGrafico(tipo) {
            let chart;
            if (tipo === 'genero') {
                chart = chartGenero;
            } else if (tipo === 'color') {
                chart = chartColor;
            } else if (tipo === 'edad') {
                chart = chartEdad;
            }

            if (chart) {
                let imgUri = chart.getImageURI();
                let link = document.createElement('a');
                link.href = imgUri;
                link.download = `grafico_${tipo}.png`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }
    </script>
@endsection

