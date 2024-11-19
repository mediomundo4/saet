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
    <h2>Reportes - Por Dependencia</h2>
    <br><br>
    <div style="width:600px">  
        <form action="/reporte/generar_rpordpdnc" method="post">
            @csrf
            <div class="input-group" style="padding:5px">
                <label for="id_departamento" class="col-sm-4">Dependencia</label>
                <select name="id_departamento" id="id_departamento" class="form-control col">
                    <option value="">Seleccione...</option>
                    @foreach($departamentos as $departamento)
                        <option value="{{ $departamento->id_departamento }}">{{ $departamento->departamento }}</option>
                    @endforeach
                </select>   
            </div><br>
            <div>
                <center>
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-file-pdf-o"></i> Generar</button>
                </center>
            </div>
        </form>
    </div>  
</center>

@endsection