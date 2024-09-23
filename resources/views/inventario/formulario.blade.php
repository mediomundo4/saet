@extends('layout.header')

@section('contenido')    
    <center>
        
    <script>
        $(document).ready(function(){  
          
            $("#id_marca, #id_tipo_equipo, #id_modelo, #id_procesador, #id_unidad_disco, #id_sistema_operativo").select2({
                placeholder: "Seleccione..."                  
            });           

            $("#id_tipo_equipo").change(function(){                
                var tipo = $(this).val();
                // alert(tipo);
                if (tipo != 1 && tipo != 2 && tipo != 12 ){
                    $(".frm_oculto").hide(1700);
                } else {
                    $(".frm_oculto").show(1700);
                }

                var datos = {
                    id_tipo_equipo: tipo,
                };

                $.ajax({
                    url: '/inventario/buscarmrca',
                    method: 'get',
                    dataType:'json',
                    data: datos,
                }).done(function(data){
                    //console.log(data);
                    $("#id_marca").empty();
                    $("#id_marca").append('<option>Seleccione...</option>');
                    $.each(data, function(id, value){ 
                        $("#id_marca").append('<option value="'+value.id_marca+'">'+value.marca+'</option>');                                
                    });
                });
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
                        $("#id_modelo").append('<option value="'+value.id_modelo+'">'+value.modelo+'</option>');
                    });
                });
            });

            $("#frm_cpu").submit(function(){
                    var FormData = $(this).serialize();
                    $.ajax({
                        url: '/inventario/createcpu',
                        method: 'post',
                        data: FormData,
                        dataType: 'json'
                    }).done(function(data){
                        if(data.estado == 'insertado'){
                            $("#unidad_disco").val('');
                            $("#id_procesador").append('<option value="'+data.id+'" selected >'+data.procesador+'</option>');
                            swal('', data.msj, 'success');
                            $("#ModalCpu").modal('hide');
                        }else{
                            $("#unidad_disco").val('');
                            swal('', data.msj, 'success');
                            $("#ModalCpu").modal('hide');
                        }
                    })
                    return false
                });

                $("#frm_hdisk").submit(function(){
                    var FormData = $(this).serialize();
                    $.ajax({
                        url: '/inventario/createhdidk',
                        method: 'post',
                        data: FormData,
                        dataType: 'json'
                    }).done(function(data){
                        if(data.estado == 'insertado'){
                            $("#unidad_disco").val('');
                            $("#id_unidad_disco").append('<option value="'+data.id+'" selected >'+data.unidad_disco+'</option>');
                            swal('', data.msj, 'success');
                            $("#ModalHDisk").modal('hide');
                        }else{
                            $("#unidad_disco").val('');
                            swal('', data.msj, 'success');
                            $("#ModalHDisk").modal('hide');
                        }
                    })
                    return false
                });
        }); //fin document.ready

        
    </script>

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
        
        <img src="{{ asset('img/form.png') }}" alt="" width="135" height="95">
        <br>
        <h2>Formulario - Inventario de Equipos</h2>
        <br>
        <div style="width:600px">
            <form action="/inventario/create" method="post">
                @csrf
                <div class="input-group" style="padding:5px">
                    <label for="Tipo de  Equipo" class="col-sm-4">Tipo de  Equipo</label>
                    <select name="id_tipo_equipo" id="id_tipo_equipo" class="form-control" required>
                        <option value="" required>Seleccione...</option>
                        @foreach($tipos as $tipo)
                            <option value="{{$tipo->id_tipo_equipo}}">{{ $tipo->tipo_equipo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group" style="padding:5px">
                    <label for="id_marca" class="col-sm-4">Marca</label>
                    <select name="id_marca" id="id_marca" class="form-control col-8" required style="">
                        <option value="" required>Seleccione...</option>                                
                    </select>
                </div>
                <div class="input-group" style="padding:5px">
                    <label for="id_modelo" class="col-sm-4">Modelo</label>
                    <select name="id_modelo" id="id_modelo" class="form-control col">
                        <option value="" required>Seleccione...</option>
                    </select>                            
                </div>
                <div class="input-group frm_oculto" style="padding:5px" >
                    <label for="id_procesador" class="col-sm-4">Procesador</label>
                    <select name="id_procesador" id="id_procesador" class="form-control col">
                        <option value="" required>Seleccione...</option>
                        @foreach($procesadores as $procesador)
                            <option value="{{$procesador->id_procesador}}">{{ $procesador->procesador }}</option>
                        @endforeach
                    </select>
                    <span class="btn btn-success col" id="btn_newcpu" style="max-width: 40px; border-radius:18px" data-toggle="modal" data-target="#ModalCpu"><i class="fa-solid fa-plus-circle" style="font-size: 25px; display:flex; text-align:center; justify-content:center"></i></span>
                </div>
                <div class="input-group frm_oculto" style="padding:5px" >
                    <label for="" class="col-sm-4">Memoria RAM</label>
                    <input type="text" name="memoria" id="memoria" class="form-control col" placeholder="Memoria Ram" required="required">
                </div>
                <div class="input-group frm_oculto" style="padding:5px">
                    <label for="id_unidad_disco" class="col-sm-4">Disco Duro</label>
                    <select name="id_unidad_disco" id="id_unidad_disco" class="form-control col">
                        <option value="" required>Seleccione...</option>
                        @foreach($unidades_discos as $unidad_disco)
                            <option value="{{ $unidad_disco->id_unidad_disco }}">{{ $unidad_disco->unidad_disco }}</option>
                        @endforeach
                    </select>
                    <span class="btn btn-success col" id="btn_newcpu" style="max-width: 40px; border-radius:18px" data-toggle="modal" data-target="#ModalHDisk"><i class="fa-solid fa-plus-circle" style="font-size: 25px; display:flex; text-align:center; justify-content:center"></i></span>                            
                </div>                        
                <div class="input-group frm_oculto" style="padding:5px">
                    <label for="id_sistema_operativo" class="col-sm-4">Sistema Operativo</label>
                    <select name="id_sistema_operativo" id="id_sistema_operativo" class="form-control col">
                        <option value="">Seleccione...</option>
                        @foreach ($sistemas as $sistema)
                            <option value="{{ $sistema->id_sistema_operativo }}">{{ $sistema->sistema_operativo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group" style="padding:5px">
                    <label for="fecha_invequipo" class="col-sm-4">Fecha</label>
                    <div class="col" style="border: 1px solid silver; border-radius:5"><?php echo date("d-m-Y"); ?></div>
                    <input type="hidden" name="fecha_invequipo" id="fecha_invequipo" class="form-control col" placeholder="Fecha de inventario" value="<?php echo date("Y-m-d"); ?>" required="required">
                </div>
                <div class="input-group" style="padding:5px">
                    <label for="nserial" class="col-sm-4">N° Serial</label>
                    <input type="text" name="nserial" id="nserial" class="form-control col" placeholder="Serial Del Equipo" required="required">
                </div>
                <div class="input-group" style="padding:5px">
                    <label for="bien_nacional" class="col-sm-4">Bien Nacional</label>
                    <input type="text" name="bien_nacional" id="bien_nacional" class="form-control col" placeholder="Bien Nacional" required="required">
                </div>
                <div style="padding-top:10px">
                    <center>
                        <button type="submit" class="btn btn-success" style="width:250px; height:40px"><i class="fa fa-floppy-o">Guardar</i></button>                        
                    </center>
                </div>
            </form>
        </div>

      
        <!-- Modal CPU -->
        <div class="modal fade" id="ModalCpu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo Procesador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="frm_cpu">
                            @csrf
                            <div class="input-group">
                                <label for="procesador" class="col-3">Procesador</label>
                                <input type="text" class="form-control col" name="procesador" id="procesador" placeholder="Procesador" required>
                            </div>
                            <br>
                            <div class="input-grup">
                                <center>
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-o"></i> Guardar</button>
                                </center>
                            </div>
                        </form>
                    </div>   
                    
                </div>
            </div>
        </div>
        <!-- Fin Modal CPU -->
        
        <!-- Modal Disco Duro-->
        <div class="modal fade" id="ModalHDisk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registrar Nuevo Disco Duro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="frm_hdisk" >
                            @csrf
                            <div class="input-group">
                                <label for="unidad_disco" class="col-3">Disco Duro</label>
                                <input type="text" class="form-control col" name="unidad_disco" id="unidad_disco" placeholder="Disco Duro" required>
                            </div>
                            <br>
                            <div class="input-grup">
                                <center>
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-o"></i> Guardar</button>
                                </center>
                            </div>
                        </form>
                    </div>
                
                </div>
            </div>
        </div>
        <!-- Fin Modal Disco Duro-->

    </center>
   
    
@endsection