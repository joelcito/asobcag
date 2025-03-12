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
                        </div>
                        <div class="col-md-4">
                            <div id="chartEdad" style="width:100%; height:400px;"></div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div id="chartPeso" style="width:100%; height:400px;"></div>
                        </div>
                        <div class="col-md-4">
                            <div id="chartPesoNacimiento" style="width:100%; height:400px;"></div>
                        </div>
                        <div class="col-md-4">
                            <div id="chartPesoDestete" style="width:100%; height:400px;"></div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div id="chartPesoMayor" style="width:100%; height:400px;"></div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div id="map" style="height: 300px; border-radius: 8px;"></div>
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
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

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

            //MAPA
            let criadero = {!! json_encode($criadero) !!};

            let map = L.map('map', {scrollWheelZoom: false}).setView([-16.5004, -68.1500], 6);
            // ⚡ Forzar el tamaño después de cargar la página y ajustar al tamaño del contenedor
            setTimeout(() => {
                map.invalidateSize();
            }, 300); // 1 segundo después de la carga

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);            

            // Si el criadero tiene coordenadas, agregar el marcador
            if (criadero && criadero.latitud && criadero.longitud) {
                let lat = parseFloat(criadero.latitud);
                let lng = parseFloat(criadero.longitud);

                map.setView([lat, lng], 15);

                // Definir el icono de Leaflet manualmente
                let customIcon = L.icon({
                    iconUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png',
                    shadowUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png',
                    iconSize: [25, 41], // Tamaño del icono
                    iconAnchor: [12, 41], // Punto de anclaje
                    popupAnchor: [1, -34], // Punto del popup
                    shadowSize: [41, 41] // Tamaño de la sombra
                });

                // Usar el icono en el marcador
                L.marker([lat, lng], { icon: customIcon }).addTo(map)
                    .bindPopup(`Criadero: ${criadero.nombre}<br>Lat: ${lat}, Lng: ${lng}`)
                    .openPopup();
            }
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

            // 📊 Datos de Promedio de Peso Mayor y Menor por Año
            var datosPeso = google.visualization.arrayToDataTable([
                ['Año', 'Promedio Peso Mayor', 'Promedio Peso Menor'],
                @foreach($pesos as $p)
                    ['{{ $p->anio }}', {{ $p->peso_max_promedio ?? 0 }}, {{ $p->peso_min_promedio ?? 0 }}],
                @endforeach
            ]);

            var opcionesPeso = {
                title: 'Promedio de Peso Mayor y Menor por Año',
                hAxis: { title: 'Año' },
                vAxis: { title: 'Peso (kg)' },
                legend: { position: 'bottom' },
                colors: ['#1b9e77', '#d95f02']
            };

            var chartPeso = new google.visualization.ColumnChart(document.getElementById('chartPeso'));
            chartPeso.draw(datosPeso, opcionesPeso);
            // 📊 Datos de Promedio de Peso Mayor y Menor por Año <= 1
            var datosPesoNacimiento = google.visualization.arrayToDataTable([
                ['Año', 'Promedio Peso Mayor', 'Promedio Peso Menor'],
                @foreach($pesosNacimiento as $p)
                    ['{{ $p->anio }}', {{ $p->peso_max_promedio ?? 0 }}, {{ $p->peso_min_promedio ?? 0 }}],
                @endforeach
            ]);

            var opcionesPesoNacimiento = {
                title: 'Promedio de Peso Mayor y Menor, menores a 1 año',
                hAxis: { title: 'Año' },
                vAxis: { title: 'Peso (kg)' },
                legend: { position: 'bottom' },
                colors: ['#1b9e77', '#d95f02']
            };

            var chartPesoNacimiento = new google.visualization.ColumnChart(document.getElementById('chartPesoNacimiento'));
            chartPesoNacimiento.draw(datosPesoNacimiento, opcionesPesoNacimiento);
            // 📊 Datos de Promedio de Peso Mayor y Menor por motivo destete
            var datosPesoDestete = google.visualization.arrayToDataTable([
                ['Año', 'Promedio Peso Mayor', 'Promedio Peso Menor'],
                @foreach($pesosDestete as $p)
                    ['{{ $p->anio }}', {{ $p->peso_max_promedio ?? 0 }}, {{ $p->peso_min_promedio ?? 0 }}],
                @endforeach
            ]);

            var opcionesPesoDestete = {
                title: 'Promedio de Peso Mayor y Menor, por motivo destete',
                hAxis: { title: 'Año' },
                vAxis: { title: 'Peso (kg)' },
                legend: { position: 'bottom' },
                colors: ['#1b9e77', '#d95f02']
            };

            var chartPesoDestete = new google.visualization.ColumnChart(document.getElementById('chartPesoDestete'));
            chartPesoDestete.draw(datosPesoDestete, opcionesPesoDestete);
            // 📊 Datos de Promedio de Peso Mayor y Menor, mayores a 2 años
            var datosPesoMayor = google.visualization.arrayToDataTable([
                ['Año', 'Promedio Peso Mayor', 'Promedio Peso Menor'],
                @foreach($pesosMayor as $p)
                    ['{{ $p->anio }}', {{ $p->peso_max_promedio ?? 0 }}, {{ $p->peso_min_promedio ?? 0 }}],
                @endforeach
            ]);

            var opcionesPesoMayor = {
                title: 'Promedio de Peso Mayor y Menor, mayores a 2 años',
                hAxis: { title: 'Año' },
                vAxis: { title: 'Peso (kg)' },
                legend: { position: 'bottom' },
                colors: ['#1b9e77', '#d95f02']
            };

            var chartPesoMayor = new google.visualization.ColumnChart(document.getElementById('chartPesoMayor'));
            chartPesoMayor.draw(datosPesoMayor, opcionesPesoMayor);
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

