@extends('layouts.app')
@section('css')

@endsection

@section('content')
<!--begin::Row-->
<div class="row g-5 gx-xl-10 mb-5 mb-xl-10">

    <div class="col-xxl-12">
        <div class="card card-flush h-md-100">
            <div class="card-body d-flex flex-column justify-content-between mt-9 bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0" style="background-position: 100% 50%; background-image:url('assets/media/stock/900x600/42.png')">
                <div class="mb-10">
                    <div class="fs-2hx fw-bold text-gray-800 text-center mb-13">
                    <span class="me-2">Sistema de Registro y Control de Camelidos.
                    <br />
                    <span class="position-relative d-inline-block text-danger">
                        <span class="position-absolute opacity-15 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                    </span></span>Asociasion Boliviana de camelidos de alta Genetica</div>
                </div>

                <!--begin::Content-->
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Content container-->
                    <div id="kt_app_content_container" class="app-container container-fluid">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-md-3">
                                <!--begin::Card widget 20-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end" style="background-color: #F1416C;background-image:url('assets/media/patterns/vector-1.png');">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $propietarios }}</span>
                                            <!--end::Amount-->
                                            <!--begin::Subtitle-->
                                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Propietarios Registrados</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex align-items-end pt-0">
                                        <!--begin::Progress-->
                                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                                {{-- <span>43 Pending</span>
                                                <span>72%</span> --}}
                                            </div>
                                            <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                                <div class="bg-white rounded h-8px" role="progressbar" style="width: 72%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 20-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-3">
                                <!--begin::Card widget 20-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end" style="background-color: #4d41f1;background-image:url('assets/media/patterns/vector-1.png');">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $usuariosDelSistema }}</span>
                                            <!--end::Amount-->
                                            <!--begin::Subtitle-->
                                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Usuarios del Sistema</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex align-items-end pt-0">
                                        <!--begin::Progress-->
                                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                                {{-- <span>43 Pending</span>
                                                <span>72%</span> --}}
                                            </div>
                                            <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                                <div class="bg-white rounded h-8px" role="progressbar" style="width: 41%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 20-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-3">
                                <!--begin::Card widget 20-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end" style="background-color: #f18241;background-image:url('assets/media/patterns/vector-1.png');">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $llama }}</span>
                                            <!--end::Amount-->
                                            <!--begin::Subtitle-->
                                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Cantidad de Llamas</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex align-items-end pt-0">
                                        <!--begin::Progress-->
                                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                                {{-- <span>43 Pending</span>
                                                <span>72%</span> --}}
                                            </div>
                                            <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                                <div class="bg-white rounded h-8px" role="progressbar" style="width: 20%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 20-->
                            </div>
                            <!--end::Col-->


                            <!--begin::Col-->
                            <div class="col-md-3">
                                <!--begin::Card widget 20-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end" style="background-color: #3e7213;background-image:url('assets/media/patterns/vector-1.png');">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $alpacas }}</span>
                                            <!--end::Amount-->
                                            <!--begin::Subtitle-->
                                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Cantidad de Alpacas</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex align-items-end pt-0">
                                        <!--begin::Progress-->
                                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                                {{-- <span>43 Pending</span>
                                                <span>72%</span> --}}
                                            </div>
                                            <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                                <div class="bg-white rounded h-8px" role="progressbar" style="width: 80%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 20-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <hr>
                        <!--end::Row-->
                        <div class="row">
                            <div class="col-xl-12">
                                <!--begin::Charts Widget 2-->
                                <div class="card card-xl-stretch mb-5 mb-xl-8">
                                    <!--begin::Header-->
                                    <div class="card-header border-0 pt-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold fs-3 mb-1">Registro de Llamas y Alpacas de la gestion {{ date('Y') }}</span>
                                            {{-- <span class="text-muted fw-semibold fs-7">More than 500 new orders</span> --}}
                                        </h3>
                                        <!--begin::Toolbar-->
                                        {{-- <div class="card-toolbar" data-kt-buttons="true">
                                            <a class="btn btn-sm btn-color-muted btn-active btn-active-primary active px-4 me-1" id="kt_charts_widget_2_year_btn">Year</a>
                                            <a class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4 me-1" id="kt_charts_widget_2_month_btn">Month</a>
                                            <a class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4" id="kt_charts_widget_2_week_btn">Week</a>
                                        </div> --}}
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <!--begin::Chart-->
                                        <div id="kt_charts_widget_2_chart" style="height: 350px"></div>
                                        <!--end::Chart-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Charts Widget 2-->
                            </div>
                        </div>
                    </div>
                    <!--end::Content container-->
                </div>
                <!--end::Content-->
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script>

    $(document).ready(function() {
        initChartsWidget4();
    });

    // var initChartsWidget4 = function() {
    function initChartsWidget4() {

        var element = document.getElementById("kt_charts_widget_2_chart");

        if ( !element ) {
            return;
        }

        var chart = {
            self: null,
            rendered: false
        };

        var initChart = function() {
            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
            var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
            // var baseColor = KTUtil.getCssVariableValue('--bs-warning');
            var baseColor = KTUtil.getCssVariableValue('--bs-info');
            // var secondaryColor = KTUtil.getCssVariableValue('--bs-gray-300');
            var secondaryColor = KTUtil.getCssVariableValue('--bs-primary');

            var options = {
                series: [{
                    name: 'Llama',
                    // data: [44, 55, 57, 56, 61, 58]
                    data: @json($registrosEjemplaresLlama)

                }, {
                    name: 'Alpaca',
                    // data: [76, 85, 101, 98, 87, 105]
                    data: @json($registrosEjemplaresAlpaca)
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'bar',
                    height: height,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: ['30%'],
                        borderRadius: 4
                    },
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    // categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            // return "$" + val + " thousands"
                            return val + "  registros"
                        }
                    }
                },
                colors: [baseColor, secondaryColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                }
            };

            chart.self = new ApexCharts(element, options);
            chart.self.render();
            chart.rendered = true;
        }

        // Init chart
        initChart();

        // Update chart on theme mode change
        KTThemeMode.on("kt.thememode.change", function() {
            if (chart.rendered) {
                chart.self.destroy();
            }

            initChart();
        });

    }
</script>
@endsection
