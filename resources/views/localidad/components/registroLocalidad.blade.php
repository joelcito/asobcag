<div class="modal-body scroll-y">
    <form id="formularioRecepcionFacuraContingenciaFueraLineaEentoSignificativo">
        <div class="row">
            <div class="col-md-4">
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold form-label mb-2 required">Documento Sector</label>
                    <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalLocalidad" data-hide-search="true" class="form-select form-select-solid fw-bold" name="pais_id" id="pais_id" class="form-control" onchange="buscarHijos(this)">
                        <option></option>
                        @foreach ($paises as $pais)
                            <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="fv-row mb-7">
                    <label class="required fw-semibold fs-6 mb-2">Departamento</label>
                    <input type="text" class="form-control form-control-sm buscar_ejemplar" id="nombre_busquedas" name="nombre_busquedas">
                </div>
            </div>
            <div class="col-md-4">
                <div class="fv-row mb-7">
                    <label class="required fw-semibold fs-6 mb-2">Provincia</label>
                    <input type="text" class="form-control form-control-sm buscar_ejemplar" id="nombre_busquedas" name="nombre_busquedas">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="fv-row mb-7">
                    <label class="required fw-semibold fs-6 mb-2">Municipio</label>
                    <input type="number" class="form-control form-control-sm buscar_ejemplar" id="numero_registro_busqueda" name="numero_registro_busqueda">
                    <input type="hidden" id="sexo_busqueda" name="sexo_busqueda">
                </div>
            </div>
            <div class="col-md-6">
                <div class="fv-row mb-7">
                    <label class="required fw-semibold fs-6 mb-2">Comunidad</label>
                    <input type="text" class="form-control form-control-sm buscar_ejemplar" id="nombre_busquedas" name="nombre_busquedas">
                </div>
            </div>
        </div>
    </form>
    <div id="table_ejemplares_buscados">

    </div>
</div>

@section('formularioBusquedaJs')
    <script>
        $(document).ready(function() {

            $("#pais_id").select2();

            // let debounceTimer;
            // $('.buscar_ejemplar').keyup(function(){
            //     clearTimeout(debounceTimer);
            //     debounceTimer = setTimeout(function() {
            //         buscarEjemplar();
            //     }, 300);
            // })

            // $('#kt_docs_repeater_basic').repeater({
            //     initEmpty: false,

            //     defaultValues: {
            //         'text-input': 'foo'
            //     },

            //     show: function () {
            //         $(this).slideDown();
            //     },

            //     hide: function (deleteElement) {
            //         $(this).slideUp(deleteElement);
            //     }
            // });

        });

        function buscarHijos(valor){
            console.log(valor.value)
        }
    </script>
@endsection



