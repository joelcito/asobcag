<div class="modal-header" id="kt_modal_add_user_header">
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

    </div>
</div>

@section('formularioBusquedaJs')
    <script>
        $(document).ready(function() {

            let debounceTimer;
            $('.buscar_ejemplar').keyup(function(){
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function() {
                    buscarEjemplar();
                }, 300);
            })

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
    </script>
@endsection



