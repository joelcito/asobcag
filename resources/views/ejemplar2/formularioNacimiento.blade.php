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
<div class="modal fade" id="modalMedicacion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE MEDICACION <span class="text-info" id="nombre_busqueda"></span></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioMedicacion">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Producto Veterinario</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalMedicacion"
                                    class="form-select form-select-solid fw-bold" name="producto_veterinario_id" id="producto_veterinario_id">
                                    <option></option>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="ejemplar_id_medicacion" id="ejemplar_id_medicacion" value="{{ $ejemplar? $ejemplar->id : 0 }}">
                                <div class="text-danger error-message" id="error-producto_veterinario_id"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold form-label mb-2 required">Responsable</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalMedicacion"
                                    class="form-select form-select-solid fw-bold" name="responsable_id" id="responsable_id">
                                    <option></option>
                                    @foreach ($usuarios as $responsable)
                                        <option value="{{ $responsable->id }}">{{ $responsable->nombres.' '.$responsable->ap_paterno }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-responsable_id"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Fecha</label>
                                <input type="date" class="form-control form-control-sm" id="fecha" name="fecha">
                                <div class="text-danger error-message" id="error-fecha"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Tipo</label>
                                <input type="text" class="form-control form-control-sm" id="tipo" name="tipo">
                                <div class="text-danger error-message" id="error-tipo"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Dosis</label>
                                <input type="number" class="form-control form-control-sm" id="dosis" name="dosis">
                                <div class="text-danger error-message" id="error-dosis"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Unidades</label>
                                <input type="text" class="form-control form-control-sm" id="unidades" name="unidades">
                                <div class="text-danger error-message" id="error-unidades"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fv-row mb-7">
                                <label class="fw-semibold fs-6 mb-2">Observacion</label>
                                <input type="text" class="form-control form-control-sm" id="observacion" name="observacion">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm w-100 btn-success" onclick="guardarMedicacion()">Guardar</button>
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
<div class="modal fade" id="modalRegistroMorfologico" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        @if ($tipo === 'LLAMA')
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_user_header">
                    <h3 class="fw-bold">FORMULARIO DE REGISTRO MORFOLOGICO</h3>
                </div>
                <div class="modal-body scroll-y">
                    <form id="formularioRegistroMorfologico">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Motivo</label>
                                    {{-- <input type="text" class="form-control form-control-sm" id="motivo_morfologico" name="motivo_morfologico" required> --}}
                                    <select name="motivo_morfologico" id="motivo_morfologico" class="form-control form-control-sm">
                                        <option value="Destete">Destete</option>
                                        <option value="1 Esquila">1 Esquila</option>
                                        <option value="2 Esquila">2 Esquila</option>
                                        <option value="3 Esquila">3 Esquila</option>
                                        <option value="4 Esquila">4 Esquila</option>
                                        <option value="5 Esquila">5 Esquila</option>
                                        <option value="Otro">Otro</option>
                                    </select>
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
    |                                   @endforeach
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
            </div>
        @elseif($tipo === 'ALPACA')

            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_user_header">
                    <h3 class="fw-bold">FORMULARIO DE REGISTRO MORFOLOGICO</h3>
                </div>
                <div class="modal-body scroll-y">
                    <form id="formularioRegistroMorfologicoAlpaca">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Motivo</label>
                                    {{-- <input type="text" class="form-control form-control-sm" id="motivo_morfologico_alpaca" name="motivo_morfologico_alpaca" required> --}}
                                    <select name="motivo_morfologico_alpaca" id="motivo_morfologico_alpaca" class="form-control form-control-sm" required>
                                        <option value="Destete">Destete</option>
                                        <option value="1 Esquila">1 Esquila</option>
                                        <option value="2 Esquila">2 Esquila</option>
                                        <option value="3 Esquila">3 Esquila</option>
                                        <option value="4 Esquila">4 Esquila</option>
                                        <option value="5 Esquila">5 Esquila</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                    <div class="text-danger error-message" id="error-motivo_morfologico_alpaca"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Fecha</label>
                                    <input type="date" class="form-control form-control-sm" id="fecha_morfologico_alpaca" name="fecha_morfologico_alpaca" required>
                                    <div class="text-danger error-message" id="error-fecha_morfologico_alpaca"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Evaluador</label>
                                    <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalRegistroMorfologico" class="form-select form-select-solid fw-bold"  name="evaluador_id_morfologico_alpaca" id="evaluador_id_morfologico_alpaca"  required required>
                                        <option></option>
                                        @foreach ($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
    |                                   @endforeach
                                    </select>
                                    <div class="text-danger error-message" id="error-evaluador_id_morfologico_alpaca"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Densidad</label>
                                    <input type="text" class="form-control form-control-sm" id="densidad_morfologico_alpaca" name="densidad_morfologico_alpaca" required>
                                    <div class="text-danger error-message" id="error-densidad_morfologico_alpaca"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Rizo</label>
                                    <input type="text" class="form-control form-control-sm" id="rizo_morfologico_alpaca" name="rizo_morfologico_alpaca" required>
                                    <div class="text-danger error-message" id="error-rizo_morfologico_alpaca"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Cabeza</label>
                                    <input type="text" class="form-control form-control-sm" id="cabeza_morfologico_alpaca" name="cabeza_morfologico_alpaca" required>
                                    <div class="text-danger error-message" id="error-cabeza_morfologico_alpaca"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Calce</label>
                                    <input type="text" class="form-control form-control-sm" id="calce_morfologico_alpaca" name="calce_morfologico_alpaca" required>
                                    <div class="text-danger error-message" id="error-calce_morfologico_alpaca"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Balance</label>
                                    <input type="text" class="form-control form-control-sm" id="balance_morfologico_alpaca" name="balance_morfologico_alpaca" required>
                                    <div class="text-danger error-message" id="error-balance_morfologico_alpaca"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm w-100 btn-success" onclick="guardarMorfologicoAlpaca()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add task-->


<!--begin::Modal - Add task-->
<div class="modal fade" id="modalRegistroBiometrico" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        @if ($tipo === 'LLAMA')
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
                                    {{-- <input type="text" class="form-control form-control-sm" id="motivo" name="motivo" required> --}}
                                    <select name="motivo" id="motivo" class="form-control form-control-sm" required>
                                        <option value="Nacimiento">Nacimiento</option>
                                        <option value="Destete">Destete</option>
                                        <option value="Otro">Otro</option>
                                    </select>
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
        @elseif($tipo === 'ALPACA')
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_user_header">
                    <h3 class="fw-bold">FORMULARIO DE REGISTRO BIOMETRICO</h3>
                </div>
                <div class="modal-body scroll-y">
                    <form id="formularioRegistroBiometricoAlpaca">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Motivo</label>
                                    {{-- <input type="text" class="form-control form-control-sm" id="motivo_alpaca" name="motivo_alpaca" required> --}}
                                    <select name="motivo_alpaca" id="motivo_alpaca" class="form-control form-control-sm" required>
                                        <option value="Nacimiento">Nacimiento</option>
                                        <option value="Destete">Destete</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                    <div class="text-danger error-message" id="error-motivo_alpaca"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Fecha</label>
                                    <input type="date" class="form-control form-control-sm" id="fecha_alpaca" name="fecha_alpaca" required>
                                    <div class="text-danger error-message" id="error-fecha_alpaca"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Evaluador</label>
                                    <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalRegistroBiometrico" class="form-select form-select-solid fw-bold"  name="evaluador_id_alpaca" id="evaluador_id_alpaca"  required required>
                                        <option></option>
                                        @foreach ($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
    |                                    @endforeach
                                    </select>
                                    <div class="text-danger error-message" id="error-evaluador_id_alpaca"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Peso</label>
                                    <input type="text" class="form-control form-control-sm" id="peso_alpaca" name="peso_alpaca" required>
                                    <div class="text-danger error-message" id="error-peso_alpaca"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Talla a la Cruz</label>
                                    <input type="text" class="form-control form-control-sm" id="altura_cruz_alpaca" name="altura_cruz_alpaca" required>
                                    <div class="text-danger error-message" id="error-altura_cruz_alpaca"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Talla a la Cabeza</label>
                                    <input type="text" class="form-control form-control-sm" id="talla_cabeza_alpaca" name="talla_cabeza_alpaca" required>
                                    <div class="text-danger error-message" id="error-talla_cabeza_alpaca"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm w-100 btn-success" onclick="guardarBiometriaAlpaca()">Guardar</button>
                        </div>
                    </div>
                </div>
                <!--end::Modal body-->
            </div>
        @endif

    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add task-->

<!--begin::Modal - Add task-->
<div class="modal fade" id="modalRegistroFibras" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE REGISTRO FIBRAS</h3>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioRegistroFibras">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Laboratorio</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalRegistroFibras" class="form-select form-select-solid fw-bold"  name="laboratorio_id" id="laboratorio_id"  required required>
                                    <option></option>
                                    @foreach ($laboratorios as $laboratorio)
                                        <option value="{{ $laboratorio->id }}">{{ $laboratorio->nombre }}</option>
|                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-laboratorio_id"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Equipo</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalRegistroFibras" class="form-select form-select-solid fw-bold"  name="equipo_id" id="equipo_id"  required required>
                                    <option></option>
                                    @foreach ($equipos as $equipo)
                                        <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
|                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-equipo_id"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Fecha Muestreo</label>
                                <input type="date" class="form-control form-control-sm" id="fecha_muestreo" name="fecha_muestreo" required>
                                <div class="text-danger error-message" id="error-fecha_muestreo"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Fecha Analisis</label>
                                <input type="date" class="form-control form-control-sm" id="fecha_analisis" name="fecha_analisis" required>
                                <div class="text-danger error-message" id="error-fecha_analisis"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Zona corporal</label>
                                <input type="text" class="form-control form-control-sm" id="zona_corporal" name="zona_corporal" required>
                                <div class="text-danger error-message" id="error-zona_corporal"></div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">FD</label>
                                <input type="text" class="form-control form-control-sm" id="fd" name="fd" required>
                                <div class="text-danger error-message" id="error-fd"></div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">SD</label>
                                <input type="text" class="form-control form-control-sm" id="sd" name="sd" required>
                                <div class="text-danger error-message" id="error-sd"></div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">CV</label>
                                <input type="text" class="form-control form-control-sm" id="cv" name="cv" required>
                                <div class="text-danger error-message" id="error-cv"></div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">FC</label>
                                <input type="text" class="form-control form-control-sm" id="fc" name="fc" required>
                                <div class="text-danger error-message" id="error-fc"></div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">PM</label>
                                <input type="text" class="form-control form-control-sm" id="pm" name="pm" required>
                                <div class="text-danger error-message" id="error-pm"></div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">MFD</label>
                                <input type="text" class="form-control form-control-sm" id="mfd" name="mfd" required>
                                <div class="text-danger error-message" id="error-mfd"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-sm w-100 btn-success" onclick="guardarFibra()">Guardar</button>
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
<div class="modal fade" id="modalRegistroEsquila" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h3 class="fw-bold">FORMULARIO DE REGISTRO ESQUILAS</h3>
            </div>
            <div class="modal-body scroll-y">
                <form id="formularioRegistroEsquila">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Esquilador</label>
                                <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalRegistroEsquila" class="form-select form-select-solid fw-bold"  name="esquilador_id" id="esquilador_id"  required required>
                                    <option></option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
|                                    @endforeach
                                </select>
                                <div class="text-danger error-message" id="error-esquilador_id"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Fecha</label>
                                <input type="date" class="form-control form-control-sm" id="fecha_esquila" name="fecha_esquila" required>
                                <div class="text-danger error-message" id="error-fecha_esquila"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Tipo Esquila</label>
                                <input type="text" class="form-control form-control-sm" id="tipo_esquila" name="tipo_esquila" required>
                                <div class="text-danger error-message" id="error-tipo_esquila"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fv-row mb-7">
                                <div class="form-check form-switch form-check-custom form-check-solid mt-9">
                                    <input class="form-check-input" type="checkbox" id="inca_esquila" name="inca_esquila"/>
                                    <label class="form-check-label" for="inca_esquila">
                                        Inca Esquila ?
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Peso Manto</label>
                                <input type="text" class="form-control form-control-sm" id="peso_manto" name="peso_manto" required>
                                <div class="text-danger error-message" id="error-peso_manto"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Peso Cuello</label>
                                <input type="text" class="form-control form-control-sm" id="peso_cuello" name="peso_cuello" required>
                                <div class="text-danger error-message" id="error-peso_cuello"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Peso Braga</label>
                                <input type="text" class="form-control form-control-sm" id="peso_braga" name="peso_braga" required>
                                <div class="text-danger error-message" id="error-peso_braga"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Peso Total</label>
                                <input type="text" class="form-control form-control-sm" id="peso_total" name="peso_total" required>
                                <div class="text-danger error-message" id="error-peso_total"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Longitud</label>
                                <input type="text" class="form-control form-control-sm" id="longitud" name="longitud" required>
                                <div class="text-danger error-message" id="error-longitud"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Observacion</label>
                                <input type="text" class="form-control form-control-sm" id="observacion" name="observacion" required>
                                <div class="text-danger error-message" id="error-observacion"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-sm w-100 btn-success" onclick="guardarEsquila()">Guardar</button>
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
                    <form id="formularioNacimiento" action="{{ route('ejemplar.guardarEjemplar') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="tipo" name="tipo" value="{{ $tipo }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Numero Registro</label>
                                    <input type="text" class="form-control form-control-sm" id="car_id" name="car_id" value="{{ ($ejemplar)? $ejemplar->numero_registro : $numeroSiguiente }}">
                                    <input type="hidden" id="ejemplar_id" name="ejemplar_id" value="{{ $ejemplar ? $ejemplar->id : 0  }}">
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
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="fw-semibold fs-6 mb-2">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control form-control-sm" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ ($ejemplar)? $ejemplar->fecha_nacimiento : '' }}" >
                                    <div class="text-danger error-message" id="error-fecha_nacimiento"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Fecha de Registro</label>
                                    <input type="date" class="form-control form-control-sm" id="fecha_registro" name="fecha_registro" value="{{ ($ejemplar)? $ejemplar->fecha_nacimiento : date('Y-m-d') }}" readonly>
                                    <div class="text-danger error-message" id="error-fecha_registro"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2">Tipo Parto</label>
                                    <input type="text" class="form-control form-control-sm" id="tipo_parto" name="tipo_parto" value="{{ ($ejemplar)? $ejemplar->tipo_parto : '' }}">
                                    <div class="text-danger error-message" id="error-tipo_parto"></div>
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
                                <label class="fs-6 fw-semibold form-label mb-2">Padre</label>
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
                                <label class="fs-6 fw-semibold form-label mb-2">Madre</label>
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
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="fs-6 fw-semibold form-label mb-2">Imagenes</label>
                                <input type="file" class="form-control form-control-sm" id="imagenes" name="imagenes[]" multiple accept="image/*">
                            </div>
                        </div>
                        <!-- Tabla de vista previa -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h6>Vista previa de nuevas imágenes</h6>
                                <div id="vistaPrevia" class="d-flex flex-wrap gap-2 border p-2">
                                    <div id="mensajeVacio" class="text-muted">No hay imágenes seleccionadas</div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="separator separator-solid"></div>
                        @if($ejemplar)
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
                                                <li class="nav-item w-100">
                                                    <a class="nav-link btn btn-active-light-info btn-color-gray-600 btn-active-color-primary rounded-bottom-0" data-bs-toggle="tab" href="#kt_tab_pane_3">Ingreso de Fibra</a>
                                                </li>
                                                <li class="nav-item w-100">
                                                    <a class="nav-link btn btn-active-light-info btn-color-gray-600 btn-active-color-primary rounded-bottom-0" data-bs-toggle="tab" href="#kt_tab_pane_4">Registro de Esquila</a>
                                                </li>
                                                <li class="nav-item w-100">
                                                    <a class="nav-link btn btn-active-light-info btn-color-gray-600 btn-active-color-primary rounded-bottom-0" data-bs-toggle="tab" href="#kt_tab_pane_5">Registro de Medicaciones</a>
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
                                        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                                            <div id="tabla_analisis_fibras"></div>
                                        </div>
                                        <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                                            <div id="tabla_registro_esquilas"></div>
                                        </div>
                                        <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                                            <div id="tabla_registro_medicaciones"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <h3 class="text-primary text-center">GENEALOGIA</h3>
                                </div>
                            </div>
                            @php

                                $mama = $ejemplar->madre_id;
                            @endphp
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <table class="table table-bordered ">
                                        <thead class="text-center table-primary">
                                            <tr>
                                                <th>PADRES</th>
                                                <th>ABUELOS</th>
                                                <th>TERCERA GENERACION</th>
                                                <th>CUARTA GENERACION</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-primary">
                                            <tr>
                                                <td rowspan="8">
                                                    @php
                                                        $primeraGeneracionMachoId       = $ejemplar->padre_id;
                                                        $ejemplarPrimeraGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionMachoId);
                                                    @endphp
                                                </td>
                                                <td rowspan="4">
                                                    @php
                                                        if($ejemplarPrimeraGeneracionMacho){
                                                            $primeraGeneracionMachoId       = $ejemplarPrimeraGeneracionMacho->padre_id;
                                                            $ejemplarSegundaGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionMachoId);
                                                        }else{
                                                            $ejemplarSegundaGeneracionMacho = null;
                                                        }
                                                    @endphp
                                                </td>
                                                <td rowspan="2">
                                                    @php
                                                        if($ejemplarSegundaGeneracionMacho){
                                                            $primeraGeneracionMachoId       = $ejemplarSegundaGeneracionMacho->padre_id;
                                                            $ejemplarTerceraGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionMachoId);
                                                        }else{
                                                            $ejemplarTerceraGeneracionMacho = null;
                                                        }
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionMacho){
                                                            $primeraGeneracionMachoId       = $ejemplarTerceraGeneracionMacho->padre_id;
                                                            $ejemplarCuartaGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionMachoId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionMacho){
                                                            $primeraGeneracionMachoId       = $ejemplarTerceraGeneracionMacho->madre_id;
                                                            $ejemplarCuartaGeneracionYHembra = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionMachoId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    @php
                                                        if($ejemplarSegundaGeneracionMacho){
                                                            $primeraGeneracionMachoId       = $ejemplarSegundaGeneracionMacho->madre_id;
                                                            $ejemplarTerceraGeneracionHembra = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionMachoId);
                                                        }else{
                                                            $ejemplarTerceraGeneracionHembra = null;
                                                        }
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionHembra){
                                                            $primeraGeneracionMachoId       = $ejemplarTerceraGeneracionHembra->padre_id;
                                                            $ejemplarTerceraGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionMachoId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionHembra){
                                                            $primeraGeneracionMachoId       = $ejemplarTerceraGeneracionHembra->madre_id;
                                                            $ejemplarTerceraGeneracionHembra = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionMachoId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="4">
                                                    @php
                                                        if($ejemplarPrimeraGeneracionMacho){
                                                            $primeraGeneracionMachoId       = $ejemplarPrimeraGeneracionMacho->madre_id;
                                                            $ejemplarSegundaGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionMachoId);
                                                        }
                                                    @endphp
                                                </td>
                                                <td rowspan="2">
                                                    @php
                                                        if($ejemplarSegundaGeneracionMacho){
                                                            $primeraGeneracionHembraId       = $ejemplarSegundaGeneracionMacho->padre_id;
                                                            $ejemplarTerceraGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionMacho){
                                                            $primeraGeneracionHembraId       = $ejemplarTerceraGeneracionMacho->padre_id;
                                                            $ejemplarCuartaaGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionMacho){
                                                            $primeraGeneracionHembraId       = $ejemplarTerceraGeneracionMacho->madre_id;
                                                            $ejemplarCuartaaGeneracionHembra = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    @php
                                                        if($ejemplarSegundaGeneracionMacho){
                                                            $primeraGeneracionHembraId       = $ejemplarSegundaGeneracionMacho->madre_id;
                                                            $ejemplarTerceraGeneracionHembra = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionHembra){
                                                            $primeraGeneracionHembraId       = $ejemplarTerceraGeneracionHembra->padre_id;
                                                            $ejemplarCuartaaGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionHembra){
                                                            $primeraGeneracionHembraId       = $ejemplarTerceraGeneracionHembra->madre_id;
                                                            $ejemplarCuartaaGeneracionHembra = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="8">
                                                    @php
                                                        $primeraGeneracionHembraId         = $ejemplar->madre_id;
                                                        $ejemplarPrimeraGeneracionHembra = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                    @endphp
                                                </td>
                                                <td rowspan="4">
                                                    @php
                                                        if($ejemplarPrimeraGeneracionHembra){
                                                            $primeraGeneracionHembraId       = $ejemplarPrimeraGeneracionHembra->padre_id;
                                                            $ejemplarSegundaGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                                <td rowspan="2">
                                                    @php
                                                        if($ejemplarSegundaGeneracionMacho){
                                                            $primeraGeneracionHembraId       = $ejemplarSegundaGeneracionMacho->padre_id;
                                                            $ejemplarTerceraGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionMacho){
                                                            $primeraGeneracionHembraId       = $ejemplarTerceraGeneracionMacho->padre_id;
                                                            $ejemplarCuartaGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionMacho){
                                                            $primeraGeneracionHembraId       = $ejemplarTerceraGeneracionMacho->madre_id;
                                                            $ejemplarCuartaGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    @php
                                                        if($ejemplarSegundaGeneracionMacho){
                                                            $primeraGeneracionHembraId       = $ejemplarSegundaGeneracionMacho->madre_id;
                                                            $ejemplarTerceraGeneracionHembra = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionHembra){
                                                            $primeraGeneracionHembraId       = $ejemplarTerceraGeneracionHembra->padre_id;
                                                            $ejemplarCuartaGeneracionHembra = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionHembra){
                                                            $primeraGeneracionHembraId       = $ejemplarTerceraGeneracionHembra->madre_id;
                                                            $ejemplarCuartaGeneracionHembra = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="4">
                                                    @php
                                                        if($ejemplarPrimeraGeneracionHembra){
                                                            $primeraGeneracionHembraId       = $ejemplarPrimeraGeneracionHembra->madre_id;
                                                            $ejemplarSegundaGeneracionHembra = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }else{
                                                            $ejemplarSegundaGeneracionHembra = null;
                                                        }
                                                    @endphp
                                                </td>
                                                <td rowspan="2">
                                                    @php
                                                        if($ejemplarSegundaGeneracionHembra){
                                                            $primeraGeneracionHembraId       = $ejemplarSegundaGeneracionHembra->padre_id;
                                                            $ejemplarTerceraGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionMacho){
                                                            $primeraGeneracionHembraId       = $ejemplarTerceraGeneracionMacho->padre_id;
                                                            $ejemplarCuartaGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionMacho){
                                                            $primeraGeneracionHembraId       = $ejemplarTerceraGeneracionMacho->madre_id;
                                                            $ejemplarCuartaGeneracionHembra = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    @php
                                                        if($ejemplarSegundaGeneracionHembra){
                                                            $primeraGeneracionHembraId       = $ejemplarSegundaGeneracionHembra->madre_id;
                                                            $ejemplarTerceraGeneracionHembra = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionHembra){
                                                            $primeraGeneracionHembraId       = $ejemplarTerceraGeneracionHembra->padre_id;
                                                            $ejemplarCuartaGeneracionMacho = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @php
                                                        if($ejemplarTerceraGeneracionHembra){
                                                            $primeraGeneracionHembraId       = $ejemplarTerceraGeneracionHembra->madre_id;
                                                            $ejemplarCuartaGeneracionHembra = App\Models\Ejemplar::visualizarEjemplar($primeraGeneracionHembraId);
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        @endif
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

                //let formData = $(this).serialize(); // Captura los datos del formulario
                // Usar FormData para incluir archivos
                let formData = new FormData(this);

                // Limpiar mensajes de error previos
                $('.error-message').html('');
                $('.is-invalid').removeClass('is-invalid');

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,  // IMPORTANTE
                    contentType: false,  // IMPORTANTE
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
            ajaxListadoFibras();
            ajaxListadoEsquila();
            ajaxListadoMedicaciones();
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

            function ajaxListadoFibras(){
                let datos = {ejemplar_id:{{ $ejemplar->id }}};
                $.ajax({
                    url: "{{ url('ejemplar/ajaxListadoFibras') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){
                            $('#tabla_analisis_fibras').html(resultado.data.listado)
                        }else{

                        }
                    }
                })
            }

            function ajaxListadoEsquila(){
                let datos = {ejemplar_id:{{ $ejemplar->id }}};
                $.ajax({
                    url: "{{ url('ejemplar/ajaxListadoEsquila') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){
                            $('#tabla_registro_esquilas').html(resultado.data.listado)
                        }else{

                        }
                    }
                })
            }

            function ajaxListadoMedicaciones(){
                let datos = {
                    ejemplar_id:{{ $ejemplar->id }},
                    tipo : "{{ $tipo }}"
                };
                $.ajax({
                    url: "{{ url('ejemplar/ajaxListadoMedicaciones') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){
                            $('#tabla_registro_medicaciones').html(resultado.data.listado)
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

            if($("#formularioRegistroMorfologico")[0].checkValidity()){
                let datos = $('#formularioRegistroMorfologico').serializeArray();
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
                $("#formularioRegistroMorfologico")[0].reportValidity();
            }

        }

        function agregarNuevoRegistroFibra(){
            $('#modalRegistroFibras').modal('show')
        }

        function guardarFibra(){
            if($("#formularioRegistroFibras")[0].checkValidity()){
                let datos = $('#formularioRegistroFibras').serializeArray();
                datos.push({ name: "ejemplar_id", value: $('#ejemplar_id').val() });
                $.ajax({
                    url: "{{ url('ejemplar/guardarFibra') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){
                            ajaxListadoFibras();
                            $('#modalRegistroFibras').modal('hide');
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
                $("#formularioRegistroFibras")[0].reportValidity();
            }
        }

        function agregarNuevoRegistroEsquila(){
            $('#modalRegistroEsquila').modal('show')
        }

        function guardarEsquila(){
            if($("#formularioRegistroEsquila")[0].checkValidity()){
                let datos = $('#formularioRegistroEsquila').serializeArray();
                datos.push({ name: "ejemplar_id", value: $('#ejemplar_id').val() });
                $.ajax({
                    url: "{{ url('ejemplar/guardarEsquila') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){
                            ajaxListadoEsquila();
                            $('#modalRegistroEsquila').modal('hide');
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
                $("#formularioRegistroEsquila")[0].reportValidity();
            }
        }

        function guardarMedicacion(){
            if($("#formularioMedicacion")[0].checkValidity()){
                let datos = $('#formularioMedicacion').serializeArray();
                datos.push({ name: "ejemplar_id", value: $('#ejemplar_id').val() });
                $.ajax({
                    url: "{{ url('ejemplar/guardarMedicacion') }}",
                    method: "POST",
                    data: datos,
                    success: function (resultado) {
                        if(resultado.estado){
                            ajaxListadoMedicaciones();
                            $('#modalRegistroEsquila').modal('hide');
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
                $("#formularioMedicacion")[0].reportValidity();
            }
        }

        function agregarNuevoMedicacion(){
            $('#modalMedicacion').modal('show')
        }

        function guardarMorfologicoAlpaca(){
            if($("#formularioRegistroMorfologicoAlpaca")[0].checkValidity()){
                let datos = $('#formularioRegistroMorfologicoAlpaca').serializeArray();
                datos.push({ name: "ejemplar_id", value: $('#ejemplar_id').val() });
                $.ajax({
                    url: "{{ url('ejemplar/guardarMorfologicoAlpaca') }}",
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
                $("#formularioRegistroMorfologicoAlpaca")[0].reportValidity();
            }
        }

        function guardarBiometriaAlpaca(){
            if($("#formularioRegistroBiometricoAlpaca")[0].checkValidity()){
                let datos = $('#formularioRegistroBiometricoAlpaca').serializeArray();
                datos.push({ name: "ejemplar_id", value: $('#ejemplar_id').val() });
                $.ajax({
                    url: "{{ url('ejemplar/guardarBiometriaAlpaca') }}",
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
                $("#formularioRegistroBiometricoAlpaca")[0].reportValidity();
            }
        }

        /* Adicion de imagenes  */
        document.addEventListener("DOMContentLoaded", function () {
            let inputImagenes = document.getElementById("imagenes");
            let contenedorVistaPrevia = document.getElementById("vistaPrevia");
            let mensajeVacio = document.getElementById("mensajeVacio");

            let archivosSeleccionados = []; // Array para manejar las imágenes seleccionadas

            inputImagenes.addEventListener("change", function (event) {
                let archivos = Array.from(event.target.files); // Convertir FileList a Array
                if (archivos.length > 0) {
                    mensajeVacio.style.display = "none"; // Ocultar mensaje "No hay imágenes"

                    archivos.forEach((archivo) => {
                        let reader = new FileReader();
                        reader.onload = function (e) {
                            // Crear contenedor para la imagen y el botón
                            let cuadro = document.createElement("div");
                            cuadro.classList.add("d-flex", "flex-column", "align-items-center", "border", "p-1", "m-1");
                            cuadro.style.width = "100px";
                            cuadro.style.height = "130px"; // Espacio para imagen y botón

                            cuadro.innerHTML = `
                                <img src="${e.target.result}" alt="Imagen" class="img-fluid" style="max-width:100%; max-height:100px;">
                                <button type="button" class="btn btn-danger btn-sm eliminarImagen mt-1">Eliminar</button>
                            `;
                            contenedorVistaPrevia.appendChild(cuadro);

                            // Agregar archivo al array y asignar índice
                            archivosSeleccionados.push(archivo);
                            cuadro.setAttribute("data-index", archivosSeleccionados.length - 1);

                            // Listener para eliminar
                            cuadro.querySelector(".eliminarImagen").addEventListener("click", function () {
                                eliminarImagen(cuadro);
                            });

                            actualizarIndices();
                            actualizarInputArchivos(); // Actualizar input tras cada lectura
                        };
                        reader.readAsDataURL(archivo);
                    });
                }
            });

            function eliminarImagen(cuadro) {
                let indice = parseInt(cuadro.getAttribute("data-index"));
                archivosSeleccionados.splice(indice, 1);
                cuadro.remove();
                actualizarIndices();
                actualizarInputArchivos();
                if (archivosSeleccionados.length === 0) {
                    mensajeVacio.style.display = "block";
                }
            }

            function actualizarInputArchivos() {
                let dataTransfer = new DataTransfer();
                archivosSeleccionados.forEach(file => dataTransfer.items.add(file));
                inputImagenes.files = dataTransfer.files;
                console.log("Input actualizado:", inputImagenes.files); // Verificar en consola
            }

            function actualizarIndices() {
                const cuadros = contenedorVistaPrevia.querySelectorAll("div[data-index]");
                cuadros.forEach((cuadro, index) => {
                    cuadro.setAttribute("data-index", index);
                    let btn = cuadro.querySelector(".eliminarImagen");
                    if (btn) {
                        btn.setAttribute("data-index", index);
                    }
                });
            }
        });
        /* Fin Adicion de imagenes  */


   </script>
@endsection
