<div class="modal-body scroll-y">
    <form id="formularioRecepcionFacuraContingenciaFueraLineaEentoSignificativo">
        <div class="row">
            <div class="col-md-4">
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold form-label mb-2 required">Pais</label>
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
                    <label class="fs-6 fw-semibold form-label mb-2 required">Departamento</label>
                    <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalLocalidad" data-hide-search="true" class="form-select form-select-solid fw-bold" name="departamento_id" id="departamento_id" class="form-control" onchange="buscarHijos(this)">
                        <option></option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold form-label mb-2 required">Provincia</label>
                    <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalLocalidad" data-hide-search="true" class="form-select form-select-solid fw-bold" name="provincia_id" id="provincia_id" class="form-control" onchange="buscarHijos(this)">
                        <option></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold form-label mb-2 required">Municipio</label>
                    <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalLocalidad" data-hide-search="true" class="form-select form-select-solid fw-bold" name="municipio_id" id="municipio_id" class="form-control" onchange="buscarHijos(this)">
                        <option></option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold form-label mb-2 required">Comunidad</label>
                    <select data-control="select2" data-placeholder="Seleccione" data-dropdown-parent="#modalLocalidad" data-hide-search="true" class="form-select form-select-solid fw-bold" name="comunidad_id" id="comunidad_id" class="form-control" onchange="buscarHijos(this)">
                        <option></option>
                    </select>
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

            $("#pais_id, #departamento_id, #provincia_id, #municipio_id, #comunidad_id").select2();

        });

        function buscarHijos(valor){
            let datos = {padre_id:valor.value};
            $.ajax({
                url: "{{ url('localidad/buscarHijos') }}",
                method: "POST",
                data: datos,
                success: function (resultado) {
                    if(resultado.estado){
                        resetearSelects(resultado.data.nivel);
                        let select = "";
                        if (resultado.data.nivel == "1")
                            select = 'departamento_id';
                        else if (resultado.data.nivel == "2")
                            select = 'provincia_id';
                        else if (resultado.data.nivel == "3")
                            select = 'municipio_id';
                        else if (resultado.data.nivel == "4")
                            select = 'comunidad_id';

                        if(select != "")
                            llenarSelect(resultado.data, select);
                    }else{
                    }
                }
            })
        }

        function resetearSelects(nivel) {
            if (nivel == "1") {
                vaciarSelect("provincia_id");
                vaciarSelect("municipio_id");
                vaciarSelect("comunidad_id");
            } else if (nivel == "2") {
                vaciarSelect("municipio_id");
                vaciarSelect("comunidad_id");
            } else if (nivel == "3") {
                vaciarSelect("comunidad_id");
            }
        }

        function llenarSelect(data, select_id) {
            let $select = $("#" + select_id);
            $select.empty().append('<option value="">Seleccione</option>');

            $.each(data.listado, function(index, item) {
                $select.append(`<option value="${item.id}">${item.nombre}</option>`);
            });

            $select.trigger("change");
        }

        function vaciarSelect(select_id) {
            let $select = $("#" + select_id);
            $select.empty().append('<option value="">Seleccione</option>').trigger("change");
        }
    </script>
@endsection



