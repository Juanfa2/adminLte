
@if (!empty($result))
    <ul>
        @foreach($result as $item)
            @include('documentos.treeItem', ['item' => $item])
        @endforeach
    </ul>
@else
    <p>No hay datos disponibles.</p>
@endif

