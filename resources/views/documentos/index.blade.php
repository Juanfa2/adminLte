@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Carga de documentos</h1>
@stop

@section('content')

    @foreach($secciones_padre as $key => $name)
        <button class="btn btn-outline-primary" onclick="showData({{$key}})"> {{$name}} </button>
    @endforeach


    <div>
        <div id="spinner" class="spinner-border" role="status" style="display: none;">
        </div>
        <div id="data">
        </div>
    </div>

@stop

@section('js')
    <script>
        const showData = (id) =>{
            mostrarSpinner()
            $.ajax({
                url: "/seccion/" + id,
                method: 'GET',
                success: function (data) {
                    $('#data').html(data);
                    ocultarSpinner();
                },
            });
        }
        const mostrarSpinner = () => {
            $('#spinner').show();
        }
        const ocultarSpinner = () => {
            $('#spinner').hide();
        }
    </script>
@stop
