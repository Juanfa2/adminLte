<li>
    {{ $item->nombre }}
    @if (!empty($item->hijos))
        <ul>
            @foreach($item->hijos as $hijo)
                @include('documentos.treeItem', ['item' => $hijo])
            @endforeach
        </ul>
    @else

            @if($item->link != null)
            <button class="btn btn-secondary"> Editar </button>
            <ul>
                <a href="{{ $item->link->archivo }} " target="_blank"> Descargar: {{$item->link->titulo}} </a>
            </ul>
            @else
                <ul>
                    <button class="btn btn-primary"> Agregar </button>
                </ul>
            @endif
    @endif
</li>
