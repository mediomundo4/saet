@extends('layout.header')

@section('contenido')
<center> 
    <script>
        $(document).ready(function(){
            $("#id_departamento").select2({
                placeholder: 'Seleccion...'
            });
        })
    </script>   
    <br>
    <h2>Reportes - Por Rango de Fecha</h2>
    <br><br>
    <div style="width:600px">  
        <form action="/reporte/generar_rporrangofecha" method="post">
            @csrf
            <div class="input-group" style="padding:5px">
                <label for="desde" class="col-sm-4">Desde </label>
                <input type="date" name="desde" id="desde" placeholder="Desde" class="form-control col">
            </div>
            <div class="input-group" style="padding:5px">
                <label for="hasta" class="col-sm-4">Hasta2 </label>
                <input type="date" name="hasta" id="hasta" placeholder="Hasta" class="form-control col">
            </div>
            <br>
            <div>
                <center>
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-file-pdf-o"></i> Generar</button>
                </center>
            </div>
        </form>
    </div>  
</center>

@endsection