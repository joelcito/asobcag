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
<div class="modal fade" id="modalRegistroMorfologico" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE REGISTRO MORFOLOGICO</h3>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioRegistroBiometrico">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Motivo</label>
                                <input type="text" class="form-control form-control-sm" id="motivo_morfologico" name="motivo_morfologico" required>
                                <div class="text-danger error-message" id="error-motivo_morfologico"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Fecha</label>
                                <input type="date" class="form-control form-control-sm" id="fecha_morfologico" name="fecha_morfologico" required>
                                <div class="text-danger error-message" id="error-fecha_morfologico"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Evaluador</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalRegistroMorfologico" class="form-select form-select-solid fw-bold"  name="evaluador_id_morfologico" id="evaluador_id_morfologico"  required required>
                                    <option></option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
|                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-evaluador_id_morfologico"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Oreja</label>
                                <input type="text" class="form-control form-control-sm" id="oreja_morfologico" name="oreja_morfologico" required>
                                <div class="text-danger error-message" id="error-oreja_morfologico"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Cuello</label>
                                <input type="text" class="form-control form-control-sm" id="cuello_morfologico" name="cuello_morfologico" required>
                                <div class="text-danger error-message" id="error-cuello_morfologico"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Cabeza</label>
                                <input type="text" class="form-control form-control-sm" id="cabeza_morfologico" name="cabeza_morfologico" required>
                                <div class="text-danger error-message" id="error-cabeza_morfologico"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Alzada</label>
                                <input type="text" class="form-control form-control-sm" id="alzada_morfologico" name="alzada_morfologico" required>
                                <div class="text-danger error-message" id="error-alzada_morfologico"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Largo Cuerpo</label>
                                <input type="text" class="form-control form-control-sm" id="largo_cuerpo_morfologico" name="largo_cuerpo_morfologico" required>
                                <div class="text-danger error-message" id="error-largo_cuerpo_morfologico"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Amplitud Pecho</label>
                                <input type="text" class="form-control form-control-sm" id="amplitud_pecho_morfologico" name="amplitud_pecho_morfologico" required>
                                <div class="text-danger error-message" id="error-amplitud_pecho_morfologico"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Fortaleza</label>
                                <input type="text" class="form-control form-control-sm" id="fortaleza_morfologico" name="fortaleza_morfologico" required>
                                <div class="text-danger error-message" id="error-fortaleza_morfologico"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Balance</label>
                                <input type="text" class="form-control form-control-sm" id="balance_morfologico" name="balance_morfologico" required>
                                <div class="text-danger error-message" id="error-balance_morfologico"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Canias</label>
                                <input type="text" class="form-control form-control-sm" id="canias_morfologico" name="canias_morfologico" required>
                                <div class="text-danger error-message" id="error-canias_morfologico"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Copete</label>
                                <input type="text" class="form-control form-control-sm" id="copete_morfologico" name="copete_morfologico" required>
                                <div class="text-danger error-message" id="error-copete_morfologico"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Liena Superior</label>
                                <input type="text" class="form-control form-control-sm" id="linea_superior_morfologico" name="linea_superior_morfologico" required>
                                <div class="text-danger error-message" id="error-linea_superior_morfologico"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Grupa</label>
                                <input type="text" class="form-control form-control-sm" id="grupa_morfologico" name="grupa_morfologico" required>
                                <div class="text-danger error-message" id="error-grupa_morfologico"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-sm w-100 btn-success" onclick="guardarMorfologico()">Guardar</button>
                    </div>
                </div>
            </div>
            <!--end::Modal body-->
        </div>
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add task-->


<!--begin::Modal - Add task-->
<div class="modal fade" id="modalRegistroBiometrico" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE REGISTRO BIOMETRICO</h3>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioRegistroBiometrico">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Motivo</label>
                                <input type="text" class="form-control form-control-sm" id="motivo" name="motivo" required>
                                <div class="text-danger error-message" id="error-motivo"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Fecha</label>
                                <input type="date" class="form-control form-control-sm" id="fecha" name="fecha" required>
                                <div class="text-danger error-message" id="error-fecha"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Evaluador</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalRegistroBiometrico" class="form-select form-select-solid fw-bold"  name="evaluador_id" id="evaluador_id"  required required>
                                    <option></option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
|                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-evaluador_id"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Peso</label>
                                <input type="text" class="form-control form-control-sm" id="peso" name="peso" required>
                                <div class="text-danger error-message" id="error-peso"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Altura Cruz</label>
                                <input type="text" class="form-control form-control-sm" id="altura_cruz" name="altura_cruz" required>
                                <div class="text-danger error-message" id="error-altura_cruz"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Altura Grupa</label>
                                <input type="text" class="form-control form-control-sm" id="altura_grupa" name="altura_grupa" required>
                                <div class="text-danger error-message" id="error-altura_grupa"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Altura Cabeza</label>
                                <input type="text" class="form-control form-control-sm" id="altura_cabeza" name="altura_cabeza" required>
                                <div class="text-danger error-message" id="error-altura_cabeza"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Ancho Pecho</label>
                                <input type="text" class="form-control form-control-sm" id="ancho_pecho" name="ancho_pecho" required>
                                <div class="text-danger error-message" id="error-ancho_pecho"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Ancho Isquiones</label>
                                <input type="text" class="form-control form-control-sm" id="ancho_esquiones" name="ancho_esquiones" required>
                                <div class="text-danger error-message" id="error-ancho_esquiones"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Perimetro Toraxico</label>
                                <input type="text" class="form-control form-control-sm" id="perimetro_toraxico" name="perimetro_toraxico" required>
                                <div class="text-danger error-message" id="error-perimetro_toraxico"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Perimetro Abdominal</label>
                                <input type="text" class="form-control form-control-sm" id="perimetro_abdominal" name="perimetro_abdominal" required>
                                <div class="text-danger error-message" id="error-perimetro_abdominal"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Largo Cuello</label>
                                <input type="text" class="form-control form-control-sm" id="largo_cuello" name="largo_cuello" required>
                                <div class="text-danger error-message" id="error-largo_cuello"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Cuello Perimetro Sup.</label>
                                <input type="text" class="form-control form-control-sm" id="cuello_perimetro_sup" name="cuello_perimetro_sup" required>
                                <div class="text-danger error-message" id="error-cuello_perimetro_sup"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Cuello Perimetro Inf.</label>
                                <input type="text" class="form-control form-control-sm" id="cuello_perimetro_inf" name="cuello_perimetro_inf" required>
                                <div class="text-danger error-message" id="error-cuello_perimetro_inf"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Largo Oreja</label>
                                <input type="text" class="form-control form-control-sm" id="largo_oreja" name="largo_oreja" required>
                                <div class="text-danger error-message" id="error-largo_oreja"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Largo Cola</label>
                                <input type="text" class="form-control form-control-sm" id="largo_cola" name="largo_cola" required>
                                <div class="text-danger error-message" id="error-largo_cola"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Diametro Cania Ant.</label>
                                <input type="text" class="form-control form-control-sm" id="diametro_ant" name="diametro_ant" required>
                                <div class="text-danger error-message" id="error-diametro_ant"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Diametro Cania Post.</label>
                                <input type="text" class="form-control form-control-sm" id="diametro_post" name="diametro_post" required>
                                <div class="text-danger error-message" id="error-diametro_post"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-sm w-100 btn-success" onclick="guardarBiometria()">Guardar</button>
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
                        <input type="hidden" id="tipo" name="tipo" value="{{ $tipo }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Numero Registro</label>
                                    <input type="text" class="form-control form-control-sm" id="car_id" name="car_id" value="{{ ($ejemplar)? $ejemplar->numero_registro : $numeroSiguiente }}">
                                    <input type="text" id="ejemplar_id" name="ejemplar_id" value="{{ $ejemplar ? $ejemplar->id : 0  }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Microchip</label>
                                    <input type="text" class="form-control form-control-sm" id="microchip" name="microchip" value="{{ ($ejemplar)? $ejemplar->microchip : '' }}">
                                    <div class="text-danger error-message" id="error-microchip"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Nombre</label>
                                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" value="{{ ($ejemplar)? $ejemplar->nombre : '' }}">
                                    <div class="text-danger error-message" id="error-nombre"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Arete</label>
                                    <input type="text" class="form-control form-control-sm" id="arete" name="arete" value="{{ ($ejemplar)? $ejemplar->arete : '' }}">
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
                                            <option {{ ($ejemplar)? (($ejemplar->fenotipo_id == $fenotipo->id)? 'selected' : '') : '' }} value={{ $fenotipo->id }}>{{ $fenotipo->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger error-message" id="error-fenotipo_id"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mb-2 required">Color</label>
                                    <select data-control="select2" data-placeholder="Seleccione" class="form-select form-select-solid fw-bold" name="color_id" id="color_id">
                                        <option></option>
                                        @foreach ($colores as $color)
                                            <option {{ ($ejemplar)? (($ejemplar->color_id == $color->id)? 'selected' : '') : '' }} value={{ $color->id }}>{{ $color->nombre }}</option>
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
                                        <option {{ ($ejemplar)? (($ejemplar->sexo == 'Macho')? 'selected' : '') : '' }} value="Macho">Macho</option>
                                        <option {{ ($ejemplar)? (($ejemplar->sexo == 'Hembra')? 'selected' : '') : '' }} value="Hembra">Hembra</option>
                                    </select>
                                    <div class="text-danger error-message" id="error-sexo"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control form-control-sm" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ ($ejemplar)? $ejemplar->fecha_nacimiento : '' }}" >
                                    <div class="text-danger error-message" id="error-fecha_nacimiento"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Fecha de Registro</label>
                                    <input type="date" class="form-control form-control-sm" id="fecha_registro" name="fecha_registro" value="{{ ($ejemplar)? $ejemplar->fecha_nacimiento : date('Y-m-d') }}" readonly>
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
                                        <option {{ ($ejemplar)? (($ejemplar->criadero_id == $criadero->id)? 'selected' : '') : '' }} value="{{ $criadero->id }}">{{ $criadero->nombre }}</option>
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
                                        <option {{ ($ejemplar)? (($ejemplar->padre)? (($ejemplar->padre->id == $macho->id)? 'selected': '') : '') : '' }} value="{{ $macho->id }}">{{ $macho->arete }} - {{ optional($macho->color)->nombre ?? 'Sin color' }} - {{ optional($macho->fenotipo)->nombre ?? 'Sin fenotipo' }} - {{ $macho->nombre }}</option>
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
                                        <option {{ ($ejemplar)? (($ejemplar->madre)? (($ejemplar->madre->id == $hembra->id)? 'selected': '') : '') : '' }} value="{{ $hembra->id }}">{{ $hembra->arete }} - {{ optional($hembra->color)->nombre ?? 'Sin color' }} - {{ optional($hembra->fenotipo)->nombre ?? 'Sin fenotipo' }} - {{ $hembra->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-madre_id"></div>
                            </div>
                        </div>
                        <br>
                        <div class="separator separator-solid"></div>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="mb-5 hover-scroll-x">
                                    <div class="d-grid">
                                        <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                            <li class="nav-item w-100">
                                                <a class="nav-link active btn btn-active-light-info btn-color-gray-600 btn-active-color-primary rounded-bottom-0" data-bs-toggle="tab" href="#kt_tab_pane_1">Registro Biometrico</a>
                                            </li>
                                            <li class="nav-item w-100">
                                                <a class="nav-link btn btn-active-light-info btn-color-gray-600 btn-active-color-primary rounded-bottom-0" data-bs-toggle="tab" href="#kt_tab_pane_2">Registro Morfologico</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                                        <div id="tabla_biometrias"></div>
                                    </div>
                                    <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                        <div id="tabla_morfilogicos"></div>
                                    </div>
                                </div>

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
                        window.location.href = "{{ route('ejemplar.listado', [$tipo]) }}";
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

            ajaxListado();
            ajaxListadoMorfologico();
        });

        @if($ejemplar)
            function ajaxListado(){
                let datos = {ejemplar_id:{{ $ejemplar->id }}};
                $.ajax({
                    url: "{{ url('ejemplar/ajaxListadoBiometria') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){

                            console.log(resultado);

                            $('#tabla_biometrias').html(resultado.data.listado)
                        }else{

                        }
                    }
                })
            }

            function ajaxListadoMorfologico(){
                let datos = {ejemplar_id:{{ $ejemplar->id }}};
                $.ajax({
                    url: "{{ url('ejemplar/ajaxListadoMorfilogicos') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){
                            $('#tabla_morfilogicos').html(resultado.data.listado)
                        }else{

                        }
                    }
                })
            }
        @endif


        function agregarNuevoRegistroBiometrico(){

            $('motivo').val('');
            $('fecha').val('');
            $('evaluador_id').val('');
            $('ejemplar_id').val('');
            $('peso').val('');
            $('altura_cruz').val('');
            $('altura_grupa').val('');
            $('altura_cabeza').val('');
            $('ancho_pecho').val('');
            $('ancho_esquiones').val('');
            $('perimetro_toraxico').val('');
            $('perimetro_abdominal').val('');
            $('largo_cuello').val('');
            $('cuello_perimetro_sup').val('');
            $('cuello_perimetro_inf').val('');
            $('largo_oreja').val('');
            $('largo_cola').val('');
            $('diametro_ant').val('');
            $('diametro_post').val('');

            $('#modalRegistroBiometrico').modal('show');
        }

        function guardarBiometria(){
            if($("#formularioRegistroBiometrico")[0].checkValidity()){
                let datos = $('#formularioRegistroBiometrico').serializeArray();
                datos.push({ name: "ejemplar_id", value: $('#ejemplar_id').val() });
                $.ajax({
                    url: "{{ url('ejemplar/guardarBiometria') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){
                            ajaxListado();
                            $('#modalRegistroBiometrico').modal('hide');
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: resultado.data,
                            });
                        }
                    },
                    error:function(error){
                        $('.error-message').html('');
                        $('.is-invalid').removeClass('is-invalid');

                        if (error.status === 422) {
                            let errors = error.responseJSON.errors;
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
            }else{
                $("#formularioRegistroBiometrico")[0].reportValidity();
            }
        }

        function agregarNuevoRegistroMorfologico(){
            $('motivo').val('');
            $('fecha').val('');
            $('evaluador_id').val('');
            $('ejemplar_id').val('');
            $('peso').val('');
            $('altura_cruz').val('');
            $('altura_grupa').val('');
            $('altura_cabeza').val('');
            $('ancho_pecho').val('');
            $('ancho_esquiones').val('');
            $('perimetro_toraxico').val('');
            $('perimetro_abdominal').val('');
            $('largo_cuello').val('');
            $('cuello_perimetro_sup').val('');
            $('cuello_perimetro_inf').val('');
            $('largo_oreja').val('');
            $('largo_cola').val('');
            $('diametro_ant').val('');
            $('diametro_post').val('');

            $('#modalRegistroMorfologico').modal('show');
        }

        function guardarMorfologico(){
            if($("#formularioRegistroBiometrico")[0].checkValidity()){
                let datos = $('#formularioRegistroBiometrico').serializeArray();
                datos.push({ name: "ejemplar_id", value: $('#ejemplar_id').val() });
                $.ajax({
                    url: "{{ url('ejemplar/guardarMorfologico') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){
                            ajaxListadoMorfologico();
                            $('#modalRegistroMorfologico').modal('hide');
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: resultado.data,
                            });
                        }
                    },
                    error:function(error){
                        $('.error-message').html('');
                        $('.is-invalid').removeClass('is-invalid');

                        if (error.status === 422) {
                            let errors = error.responseJSON.errors;
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
            }else{
                $("#formularioRegistroBiometrico")[0].reportValidity();
            }
        }
   </script>
@endsection
