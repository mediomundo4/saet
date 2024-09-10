@extends('layout.header')

@section('contenido')    
    <center>
        
    <script>
        $(document).ready(function(){  
          
            $("#id_marca, #id_tipo_equipo, #id_modelo, #id_procesador, #id_unidad_disco").select2({
                placeholder: "Seleccione..."                  
            });           

            $("#id_tipo_equipo").change(function(){                
                var tipo = $(this).val();
                // alert(tipo);
                if (tipo != 1 && tipo != 2 && tipo != 12 ){
                    $(".frm_oculto").hide(1500);
                } else {
                    $(".frm_oculto").show(1500);
                }
            });

            $("#id_marca").change(function(){
                var tipo = $("#id_tipo_equipo").val();
                var marca = $(this).val();
                var datos = {
                    id_tipo_equipo: tipo,
                    id_marca: marca
                };
                $.ajax({
                    url: '/inventario/buscarmdlo',
                    method: 'get',
                    data: datos,
                }).done(function(data){
                    //console.log(data);
                    var dataJson = JSON.parse(data);
                    $("#id_modelo").empty();
                    $("#id_modelo").append('<option>Seleccione...</option>');
                    $.each(dataJson, function(id, value){                        
                        $("#id_modelo").append('<option value="'+id.id_modelo+'">'+value.modelo+'</option>');
                    });
                });
            });

        });

        
    </script>

        @if (session('success'))
            <script>
            swal("","{{session('success')}}","success");
            </script>
        @endif
        
        <img src="{{ asset('img/form.png') }}" alt="" width="135" height="95">
        <br>
        <h2>Formulario - Inventario de Equipos</h2>
        <br>
        <div style="width:600px">
            <form action="">
                        <div class="input-group" style="padding:5px">
                            <label for="Tipo de  Equipo" class="col-sm-4">Tipo de  Equipo</label>
                            <select name="id_tipo_equipo" id="id_tipo_equipo" class="form-control" required>
                                <option value="" required>Seleccione...</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{$tipo->id_tipo_equipo}}">{{ $tipo->tipo_equipo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group" style="padding:5px" id="div_marca">
                            <label for="id_marca" class="col-sm-4">Marca</label>
                            <select name="id_marca" id="id_marca" class="form-control col-8" required style="">
                                <option value="" required>Seleccione...</option>
                                @foreach($marcas as $marca)
                                    <option value="{{ $marca->id_marca }}">{{ $marca->marca }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group" style="padding:5px" id="div_modelo">
                            <label for="id_modelo" class="col-sm-4">Modelo</label>
                            <select name="id_modelo" id="id_modelo" class="form-control col">
                                <option value="" required>Seleccione...</option>
                            </select>
                        </div>
                        <div class="input-group frm_oculto" style="padding:5px" >
                            <label for="id_procesador" class="col-sm-4">Procesador</label>
                            <select name="id_procesador" id="id_procesador" class="form-control col">
                                <option value="" required>Seleccione...</option>
                            </select>
                        </div>
                        <div class="input-group frm_oculto" style="padding:5px" >
                            <label for="" class="col-sm-4">Memoria</label>
                            <input type="text" name="memoria" id="memoria" class="form-control col" placeholder="Memoria Ram" required="required">
                        </div>
                        <div class="input-group frm_oculto" style="padding:5px">
                            <label for="id_unidad_disco" class="col-sm-4">Disco Duro</label>
                            <select name="id_unidad_disco" id="id_unidad_disco" class="form-control col">
                                <option value="" required>Seleccione...</option>
                            </select>
                        </div>
                        <div class="input-group frm_oculto" style="padding:5px" >
                            <label for="capacidad" class="col-sm-4">Capacidad</label>
                            <input type="text" name="capacidad" id="capacidad" class="form-control col" placeholder="Capacidad del Disco" required="required">
                        </div>
                        <div class="input-group frm_oculto" style="padding:5px">
                            <label for="" class="col-sm-4">Sistema Operativo</label>
                            <select name="" id="" class="form-control col">
                                <option value="">Seleccione...</option>
                                @foreach ($sistemas as $sistema)
                                    <option value="{{ $sistema->id_sistema_operativo }}">{{ $sistema->sistema_operativo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group" style="padding:5px">
                            <label for="fecha_invequipo" class="col-sm-4">Fecha</label>
                            <input type="text" name="fecha_invequipo" id="fecha_invequipo" class="form-control col" placeholder="Fecha de inventario" required="required">
                        </div>
                        <div class="input-group" style="padding:5px">
                            <label for="nserial" class="col-sm-4">N° Serial</label>
                            <input type="text" name="nserial" id="nserial" class="form-control col" placeholder="Serial Del Equipo" required="required">
                        </div>
                        
                        <div style="padding-top:10px">
                            <center>
                                <button type="submit" class="btn btn-success" style="width:250px; height:40px"><i class="fa fa-floppy-o">Guardar</i></button>                        
                            </center>
                        </div>
                </div>
            </form>
        </div>
    </center>
   
    
@endsection