@extends('layout.header')

@section('contenido')  
    <script src="{{ asset('js/validCampoFranz.js') }}"></script>
    <script>
        $(document).ready(function(){
            //Para escribir solo letras
            $('.letra').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú');
            //Para escribir solo numeros    
            $('.numero').validCampoFranz('0123456789');
        });
    </script>
    <center>
        <!-- <div style="max-width:650;">
            <img src="{{ asset('img/Mantenimiento.png') }}" alt="">
        </div> -->
        <div>
            <form action="" method="post" id="frm_usuario">                
                <div>
                    <label for="" class="col-3">Cedula</label>
                    <input type="number" class="col form-control numero" name="cedula" id="cedula" placeholder="Cedula">
                </div>
                <div>
                    <label for="" class="col-3">Nombre</label>
                    <input type="text" class="col form-control letra" name="nombre" id="nombre" placeholder="Nombre">
                </div>
                <div>
                    <label for="" class="col-3">Apellido</label>
                    <input type="text" class="col form-control letra" name="apellido" id="apellido" placeholder="Apellido">
                </div>
                <div>
                    <label for="" class="col-3">Fecha</label>
                    <input type="date" class="col form-control" name="fecha" id="fecha" placeholder="Fecha">
                </div>
                <div>
                    <center>
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-o"></i> Aceptar</button>
                    </center>
                </div>
            </form>
        </div>
    </center>
@endsection