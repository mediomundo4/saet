@extends('layout.header')

@section('contenido')
<center> 
    <script>
        $(document).ready(function(){
            $("#id_dependencia").select2({
                placeholder: 'Seleccion...'
            });
        })
    </script>   
    <br>
    <h2>Reportes - Por Departamentos</h2>
    <br><br>
    <div style="width:600px">  
        <form action="/reporte/generar_rpordpto" method="post">
            @csrf
            <div class="input-group" style="padding:5px">
                <label for="id_dependencia" class="col-sm-4">Departamento</label>
                <select name="id_dependencia" id="id_dependencia" class="form-control col">
                    <option value="">Seleccione...</option>
                    @foreach($dependencias as $dependencia)
                        <option value="{{ $dependencia->id_dependencia }}">{{ $dependencia->dependencia }}</option>
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