<div class="card border border-primary">

    <div class="card-header">

        <div class="card-title">

            <h3 class="fw-bold">

                <i class="bi bi-camera-fill text-primary me-2"></i>

                Medición biométrica mediante fotografía

            </h3>

        </div>

    </div>


    <div class="card-body">


        {{-- =====================================================
             INSTRUCCIONES
             ===================================================== --}}

        <div class="alert alert-light-primary">

            <h5 class="fw-bold">
                Instrucciones para tomar las fotografías
            </h5>

            <div class="row mt-4">

                <div class="col-md-3">

                    <strong>
                        1. Lado derecho
                    </strong>

                    <ul class="mt-2">
                        <li>Animal completamente de perfil.</li>
                        <li>Las cuatro patas visibles.</li>
                        <li>Cámara nivelada.</li>
                        <li>Referencia métrica visible.</li>
                    </ul>

                </div>


                <div class="col-md-3">

                    <strong>
                        2. Lado izquierdo
                    </strong>

                    <ul class="mt-2">
                        <li>Animal completamente de perfil.</li>
                        <li>Las cuatro patas visibles.</li>
                        <li>Cámara nivelada.</li>
                        <li>Referencia métrica visible.</li>
                    </ul>

                </div>


                <div class="col-md-3">

                    <strong>
                        3. Frente
                    </strong>

                    <ul class="mt-2">
                        <li>Animal mirando a cámara.</li>
                        <li>Patas delanteras visibles.</li>
                        <li>Cámara centrada.</li>
                        <li>Referencia en el mismo plano.</li>
                    </ul>

                </div>


                <div class="col-md-3">

                    <strong>
                        4. Atrás
                    </strong>

                    <ul class="mt-2">
                        <li>Animal visto desde atrás.</li>
                        <li>Patas posteriores visibles.</li>
                        <li>Cámara centrada.</li>
                        <li>Referencia en el mismo plano.</li>
                    </ul>

                </div>

            </div>

        </div>


        {{-- =====================================================
             REFERENCIA
             ===================================================== --}}

        <div class="row">

            <div class="col-md-4">

                <label class="fw-bold mb-2">
                    Tamaño real de la referencia
                </label>

                <div class="input-group">

                    <input
                        type="number"
                        id="referencia_cm"
                        class="form-control"
                        value="100"
                        min="1">

                    <span class="input-group-text">
                        cm
                    </span>

                </div>

            </div>


            <div class="col-md-8">

                <div class="alert alert-warning mb-0">

                    La barra, regla o referencia debe estar
                    aproximadamente en el mismo plano que el animal.

                </div>

            </div>

        </div>


        <div class="separator my-7"></div>


        {{-- =====================================================
             FOTOS
             ===================================================== --}}

        <div class="row">


            {{-- LADO DERECHO --}}

            <div class="col-md-6 mb-5">

                <label class="fw-bold mb-2">
                    Foto lado derecho
                </label>

                <input
                    type="file"
                    id="foto_lado_derecho"
                    accept="image/*"
                    class="form-control">

            </div>


            {{-- LADO IZQUIERDO --}}

            <div class="col-md-6 mb-5">

                <label class="fw-bold mb-2">
                    Foto lado izquierdo
                </label>

                <input
                    type="file"
                    id="foto_lado_izquierdo"
                    accept="image/*"
                    class="form-control">

            </div>


            {{-- FRONTAL --}}

            <div class="col-md-6 mb-5">

                <label class="fw-bold mb-2">
                    Foto frontal
                </label>

                <input
                    type="file"
                    id="foto_frontal"
                    accept="image/*"
                    class="form-control">

            </div>


            {{-- POSTERIOR --}}

            <div class="col-md-6 mb-5">

                <label class="fw-bold mb-2">
                    Foto posterior
                </label>

                <input
                    type="file"
                    id="foto_posterior"
                    accept="image/*"
                    class="form-control">

            </div>


        </div>


        {{-- =====================================================
             PRIMERA IMPLEMENTACIÓN:
             LATERAL DERECHO
             ===================================================== --}}

        <div
            id="panelMedicionDerecha"
            class="d-none">


            <div class="separator my-7"></div>


            <h4 class="fw-bold">

                Medición - Lado derecho

            </h4>


            <p class="text-muted">

                Primero marque los dos extremos de la referencia.
                Después marque los puntos anatómicos.

            </p>


            {{-- BOTONES DE PUNTOS --}}

            <div
                class="d-flex flex-wrap gap-2 mb-5">


                <button
                    type="button"
                    class="btn btn-sm btn-light-primary btnPuntoBiometrico"
                    data-punto="referencia_inicio">

                    1. Inicio referencia

                </button>


                <button
                    type="button"
                    class="btn btn-sm btn-light-primary btnPuntoBiometrico"
                    data-punto="referencia_fin">

                    2. Fin referencia

                </button>


                <button
                    type="button"
                    class="btn btn-sm btn-light-success btnPuntoBiometrico"
                    data-punto="cabeza">

                    3. Cabeza

                </button>


                <button
                    type="button"
                    class="btn btn-sm btn-light-success btnPuntoBiometrico"
                    data-punto="cruz">

                    4. Cruz

                </button>


                <button
                    type="button"
                    class="btn btn-sm btn-light-warning btnPuntoBiometrico"
                    data-punto="grupa">

                    5. Grupa

                </button>


                <button
                    type="button"
                    class="btn btn-sm btn-light-danger btnPuntoBiometrico"
                    data-punto="suelo_delantero">

                    6. Suelo delantero

                </button>


                <button
                    type="button"
                    class="btn btn-sm btn-light-danger btnPuntoBiometrico"
                    data-punto="suelo_trasero">

                    7. Suelo trasero

                </button>


            </div>


            <div class="alert alert-info">

                Punto seleccionado:

                <strong id="puntoSeleccionadoTexto">
                    Ninguno
                </strong>

            </div>


            {{-- CANVAS --}}

            <div
                class="border rounded p-2 text-center"
                style="overflow:auto;">


                <canvas
                    id="canvasBiometricoDerecho"
                    style="
                        max-width:100%;
                        cursor:crosshair;
                    ">
                </canvas>


            </div>


            {{-- RESULTADOS --}}

            <div id="resultadosFotoBiometrico" class="mt-7 d-none">


                <h4 class="fw-bold">
                    Medidas calculadas
                </h4>


                <div class="row">


                    <div class="col-md-4">

                        <label>
                            Altura Cruz
                        </label>

                        <div class="input-group">

                            <input
                                type="text"
                                id="foto_altura_cruz"
                                class="form-control"
                                readonly>

                            <span class="input-group-text">
                                cm
                            </span>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <label>
                            Altura Grupa
                        </label>

                        <div class="input-group">

                            <input
                                type="text"
                                id="foto_altura_grupa"
                                class="form-control"
                                readonly>

                            <span class="input-group-text">
                                cm
                            </span>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <label>
                            Altura Cabeza
                        </label>

                        <div class="input-group">

                            <input
                                type="text"
                                id="foto_altura_cabeza"
                                class="form-control"
                                readonly>

                            <span class="input-group-text">
                                cm
                            </span>

                        </div>

                    </div>


                </div>
            </div>

            <div class="row mt-6">


                    <div class="col-md-4">

                        <button
                            type="button"
                            id="btnLimpiarPuntosBiometrico"
                            class="btn btn-light-danger w-100">

                            <i class="bi bi-trash"></i>

                            Limpiar puntos

                        </button>

                    </div>


                    <div class="col-md-4">

                        <button
                            type="button"
                            id="btnCalcularBiometrico"
                            class="btn btn-success w-100">

                            <i class="bi bi-calculator"></i>

                            Calcular medidas

                        </button>

                    </div>


                    <div class="col-md-4">

                        <button
                            type="button"
                            id="btnAplicarMedidasBiometrico"
                            class="btn btn-primary w-100">

                            <i class="bi bi-check-circle"></i>

                            Aplicar al formulario

                        </button>

                    </div>


                </div>


        </div>


    </div>

</div>
