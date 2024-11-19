@extends('layout.header')

@section('contenido') 
<center>
@if (session('success'))
    <script>
        swal("","{{session('success')}}","success");
    </script>
@endif

@if (session('error'))
    <script>
        swal("","{{session('error')}}","error");
    </script>
@endif

<script>
    $(document).ready(function(){
        $("#id_tipo_equipo").select2({
            placeholder: "Seleccione..."                  
        });                   
    });
</script>
<br>
<h2>Consultas Por Tipos de Equipos</h2>
<br><br>
<div style="max-width:600px">
    <form action="/inventario/listarptipo" method="get">
        @csrf
        <div class="input-group" style="padding:4px">
            <label for="id_tipo_equipo" class="col-3">Tipos Equipos</label>
            <select name="id_tipo_equipo" id="id_tipo_equipo" class="form-control col" required>
                <option value="">Seleccione...</option>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id_tipo_equipo }}">{{ $tipo->tipo_equipo }}</option>
                @endforeach
            </select>
        </div>
        <div class="iput-group" style="padding:5px">
            <center>
                <button type="submit" class="btn btn-success btn-lg"><i class="fa-solid fa-search"></i> Consultar</button>
            </center>
        </div>
    </form>
</div>
        
</center>
@endsection