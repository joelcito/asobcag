@if ($empadres->isEmpty())
    <p class="text-center text-muted">No se encontraron resultados</p>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Arete</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empadres as $empadre)
                <tr>
                    <td>{{ $empadre->id }}</td>
                    <td>{{ optional($empadre->madre)->nombre }}</td> 
                    <td>{{ optional($empadre->madre)->arete }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="seleccionarEmpadre({{ $empadre->id }}, '{{ optional($empadre->madre)->nombre }}', '{{ optional($empadre->madre)->arete }}')">
                            Seleccionar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
