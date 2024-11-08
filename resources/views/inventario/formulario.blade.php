@extends('layout.header')

@section('contenido')    
    <center>
        
    <script>
        $(document).ready(function(){  
          
            $("#id_marca,#id_tipo_equipo, #id_modelo, #id_procesador, #id_unidad_disco, #id_sistema_operativo, #memoria").select2({
                placeholder: "Seleccione..."                  
            });           

            //Para escribir solo numeros MAC   
            $('.nmac').validCampoFranz('0123456789:');
            //Para escribir solo numeros IP
            $('.nip').validCampoFranz('0123456789.');
            //Para escribir solo numeros BIEN NACIONAL
            $('.nbn').validCampoFranz('0123456789-');

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
                    }).done(function(data){ console.log(data);
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
                    });
                    return false
                });

                $("#btn_newmdlo").click(function(){
                    var tipo = $("#id_tipo_equipo").val();
                    var marca = $("#id_marca").val();
                    if(tipo == ''){
                        swal('','Para poder registrar un nuevo modelo debe seleccionar el tipo de equipo y la marca.', 'info')
                    }else{                        
                        if(marca != ''){
                            funnewmdlo(tipo, marca);
                        }else{
                            swal('', 'Debe Seleccionar una Marca.', 'error');
                        }
                    }                    
                });

                $("#frm_modelo").submit(function(){
                    var FormData = $(this).serialize();
                    $.ajax({
                        url: '/inventario/createmodelo',
                        method: 'post',
                        data: FormData,
                        dataType: 'json'
                    }).done(function(data){console.log(data);
                        if(data.estado == 'insertado'){
                            $("#modelo").val('');
                            $("#id_modelo").append('<option value="'+data.id+'" selected >'+data.modelo+'</option>');
                            swal('', data.msj, 'success');
                            $("#ModalModelo").modal('hide');
                        }else{
                            $("#modelo").val('');
                            swal('', data.msj, 'success');
                            $("#ModalModelo").modal('hide');
                        }
                    });
                    return false
                })
                
        }); //fin document.ready

        function mayus(e) {
            e.value = e.value.toUpperCase();
        }

        function funnewmdlo(idt, idm){
            // alert(idm);            
            if(idm == ''){
                swal('', 'Debe Seleccionar una Marca.', 'error');                
            }else{    
                $("#idmarca").val(idm);
                $("#idtipoequipo").val(idt);
                $("#ModalModelo").modal('show');                
            }
        }
        
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
        
        @if (session('success'))
            <script>
            swal("","{{session('success')}}","success");
            </script>
        @endif
        
        <h2>Formulario - Inventario de Equipos</h2>
        <br>
        <div style="max-width:600px">
            <form action="/inventario/create" method="post">
                @csrf
                <div class="input-group" style="padding:5px">
                    <label for="Tipo de  Equipo" class="col-sm-4">Tipo de  Equipo</label>
                    <select name="id_tipo_equipo" id="id_tipo_equipo" class="form-control">
                        <option value="">Seleccione...</option>
                        @foreach($tipos as $tipo)
                            <option value="{{$tipo->id_tipo_equipo}}">{{ $tipo->tipo_equipo }}</option>
                        @endforeach
                    </select>
                </div>
                @error('id_tipo_equipo')
                    <div class="text-danger">*Este campo es obligatorio.</div>
                @enderror                       
                <div class="input-group" style="padding:5px">
                    <label for="id_marca" class="col-sm-4">Marca</label>
                    <select name="id_marca" id="id_marca" class="form-control col-8"  style="">
                    </select>  
                </div>
                @error('id_marca')
                    <div class="text-danger">*Este campo es obligatorio.</div>
                @enderror                   
                <div class="input-group" style="padding:5px">
                    <label for="id_modelo" class="col-sm-4">Modelo</label>
                    <select name="id_modelo" id="id_modelo" class="form-control col">
                    </select>   
                    <span class="btn btn-success col" id="btn_newmdlo" style="max-width: 40px; border-radius:18px" data-toggle="ModalModelo" data-target="#ModalModelo" title="Registrar nuevo Modelo"><i class="fa-solid fa-plus-circle" style="font-size: 25px; display:flex; text-align:center; justify-content:center"></i></span>
                </div>
                @error('id_modelo')
                    <div class="text-danger">*Este campo es obligatorio.</div>
                @enderror
                <div class="input-group frm_oculto" style="padding:5px" >
                    <label for="id_procesador" class="col-sm-4">Procesador</label>
                    <select name="id_procesador" id="id_procesador" class="form-control col">
                        <option value="" >Seleccione...</option>
                        @foreach($procesadores as $procesador)
                            <option value="{{$procesador->id_procesador}}">{{ $procesador->procesador }}</option>
                        @endforeach
                    </select>
                    <span class="btn btn-success col" id="btn_newcpu" style="max-width: 40px; border-radius:18px" data-toggle="modal" data-target="#ModalCpu" title="Registrar nuevo procesador"><i class="fa-solid fa-plus-circle" style="font-size: 25px; display:flex; text-align:center; justify-content:center"></i></span>
                </div>
                @error('id_procesador')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror
                <div class="input-group frm_oculto" style="padding:5px" >
                    <label for="" class="col-sm-4">Memoria RAM</label>
                    <select name="memoria" id="memoria" class='col form-control'>
                        <option value="">Seleccione...</option>
                        <option value="2 Gb">2 Gb</option>
                        <option value="4 Gb">4 Gb</option>
                        <option value="8 Gb">8 Gb</option>
                        <option value="16 Gb">16 Gb</option>
                        <option value="32 Gb">32 Gb</option>
                        <option value="64 Gb">64 Gb</option>
                        <option value="128 Gb">128 Gb</option>
                    </select>
                </div>
                @error('memoria')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror
                <div class="input-group frm_oculto" style="padding:5px">
                    <label for="id_unidad_disco" class="col-sm-4">Disco Duro</label>
                    <select name="id_unidad_disco" id="id_unidad_disco" class="form-control col">
                        <option value="" >Seleccione...</option>
                        @foreach($unidades_discos as $unidad_disco)
                            <option value="{{ $unidad_disco->id_unidad_disco }}">{{ $unidad_disco->unidad_disco }}</option>
                        @endforeach
                    </select>
                    <span class="btn btn-success col" id="btn_newcpu" style="max-width: 40px; border-radius:18px" data-toggle="modal" data-target="#ModalHDisk"><i class="fa-solid fa-plus-circle" style="font-size: 25px; display:flex; text-align:center; justify-content:center"></i></span>
                </div>                        
                @error('id_unidad_disco')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror
                <div class="input-group frm_oculto" style="padding:5px">
                    <label for="id_sistema_operativo" class="col-sm-4">Sistema Operativo</label>
                    <select name="id_sistema_operativo" id="id_sistema_operativo" class="form-control col">
                        <option value="">Seleccione...</option>
                        @foreach ($sistemas as $sistema)
                            <option value="{{ $sistema->id_sistema_operativo }}">{{ $sistema->sistema_operativo }}</option>
                        @endforeach
                    </select>
                </div>
                @error('id_sistema_operativo')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror
                
                <div class="input-group" style="padding:5px">
                    <label for="mac_invequipo" class="col-sm-4">Mac</label>
                    <input type="text" name="mac_invequipo" id="mac_invequipo" class="form-control col"maxlength="17" placeholder="MAC Del Equipo"  onkeyup="mayus(this);">
                </div>
                @error('mac_invequipo')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror
                <div class="input-group" style="padding:5px">
                    <label for="ip_invequipo" class="col-sm-4">IP</label>
                    <input type="text" name="ip_invequipo" id="ip_invequipo" class="form-control col nip" maxlength="13" placeholder="IP Del Equipo" >
                </div>
                @error('ip_invequipo')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror

                <div class="input-group" style="padding:5px">
                    <label for="fecha_invequipo" class="col-sm-4">Fecha</label>                    
                    <input type="date" name="fecha_invequipo" id="fecha_invequipo" class="form-control col" placeholder="Fecha de inventario" value="<?php echo date("Y-m-d"); ?>" >
                </div>
                <div class="input-group" style="padding:5px">
                    <label for="nserial" class="col-sm-4">N° Serial</label>
                    <input type="text" name="nserial" id="nserial" class="form-control col" maxlength="50" placeholder="Serial Del Equipo" >
                </div>
                @error('nserial')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror
                <div class="input-group" style="padding:5px">
                    <label for="bien_nacional" class="col-sm-4">Bien Nacional</label>
                    <input type="text" name="bien_nacional" id="bien_nacional" class="form-control col nbn" maxlength="10" placeholder="Bien Nacional" >
                </div>
                @error('bien_nacional')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror
                <div class="input-group" style="padding:5px">
                    <label for="stock_invequipo" class="col-sm-4">Stock / Cantidad</label>
                    <input type="text" name="stock_invequipo" id="stock_invequipo" class="form-control col numeros" maxlength="8" placeholder="Stock" >
                </div>
                @error('stock_invequipo')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror
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
                                <input type="text" class="form-control col" name="procesador" id="procesador" placeholder="Procesador" >
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
                                <input type="text" class="form-control col" name="unidad_disco" id="unidad_disco" placeholder="Disco Duro" >
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
        
        <!-- Modal Modelo-->
        <div class="modal fade" id="ModalModelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registrar Nuevo Modelo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="frm_modelo" method="post">
                            @csrf
                            <div class="input-group">
                                <label for="modelo" class="col-3">Modelo</label>
                                <input type="text" class="form-control col" name="modelo" id="modelo" placeholder="Modelo" required>                              
                                <input type="hidden" name="idmarca" id="idmarca" required>
                                <input type="hidden" name="idtipoequipo" id="idtipoequipo" required>
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
        <!-- Fin Modal Modelo-->
    </center>
@endsection