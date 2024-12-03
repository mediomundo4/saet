@extends('layout.header')

@section('contenido') 
<center>
    @if (session('success'))
        <script>
        swal("","{{session('success')}}","success");
        </script>
    @endif
    <script>
        $(document).ready(function(){
            $("#btneq,#btnfun").hide();
            $("#id_invequipo").select2();   
            $("#id_").select2();   
            
            
            
            $("#id_invequipo").change(function(){
                var idinveq = $(this).val();
                var datos = {
                    _token: $("input[name='_token']").val(),
                    id_invequipo: idinveq
                };
                $.ajax({
                    url: '/asignacion/buscarequipo',
                    method: 'get',
                    dataType:'json',
                    data: datos,
                }).done(function(data){
                    console.log(data);
                    $("#btneq").show();
                    $("#datosinvent").empty();
                    $("#datosinvent").html(
                        '<img src="img/cargando.gif" alt="Cargando" width="50" height="50" style="border-radius:12px">'
                    );
                    setTimeout(() => {
                        $("#datosinvent").empty();
                        $("#datosinvent").html(
                            '<p style="text-align:left; ">'
                            +'Tipo Equipo: '+data[0].tipo_equipo+'<br>'
                            +'Marca: '+data[0].marca+'<br>'
                            +'Modelo: '+data[0].modelo+'<br>'
                            +'Procesador: '+data[0].procesador+'<br>'
                            +'Memoria: '+data[0].memoria+'<br>'
                            +'Disco Duro: '+data[0].unidad_disco+'<br>'
                            +'Sistema Operativo: '+data[0].sistema_operativo+'<br>'
                            +'Mac: '+data[0].mac_invequipo+'<br>'
                            +'IP: '+data[0].ip_invequipo+'<br>'
                            +'N. Serial pers.: '+data[0].nserial+'<br>'
                            +'Bien Nacional: '+data[0].bien_nacional+'<br>'
                            +'</p>'
                        );
                    }, 4000);
                    
                });
            });

            $("#cedulafun").blur(function(){
                var ci = $(this).val();

                var datos = {
                    _token: $("input[name='_token']").val(),
                    cedulafun: ci,
                };

                $.ajax({
                    url: '/asignacion/buscarfunporcedula',
                    method: 'get',
                    dataType:'json',
                    data: datos,
                }).done(function(data){
                    //console.log(data);
                    $("#id_funcionario").val(data.id_funcionario);
                    $("#datosfun").html(
                        '<img src="img/cargando.gif" alt="Cargando" width="50" height="50" style="border-radius:12px">'
                    );
                    $("#btnfun").show();
                    setTimeout(() => {
                        $("#datosfun").empty();
                        $("#datosfun").html(
                            '<p style="text-align:left; ">'
                            +'nombre: '+data.nombrefun+'<br>'
                            +'Apellido: '+data.apellidofun+'<br>'
                            +'Usuario Dominio: '+data.usuario_dominio+'<br>'
                            +'Correo Personal: '+data.correo_personal+'<br>'
                            +'Correo Institucional: '+data.correo_inst+'<br>'
                            +'Telefono: '+data.telefono+'<br>'
                            +'Piso: '+data.piso+'<br>'
                            +'Departamento: '+data.dependencia+'<br>'
                            +'Dependencia: '+data.departamento+'<br>'
                            +'Cargo: '+data.cargo+'<br>'
                            +'</p>'
                        );
                    }, 4000);
                });
            });

            $("#btnfun").click(function(){
                $("#ModalFuncionario").modal('show');
            });

            $("#btneq").click(function(){
                $("#ModalEquipo").modal('show');
            });
            
            $("#emb").hide();

            $("#ruta_memo").change(function(){
                var archivo = $(this).val();
                var ext = archivo.substring(archivo.lastIndexOf("."));
                var fileSize = this.files[0].size;
                if(ext != ".pdf" && ext != ".PDF"){
                    
                    swal("", "Solo Archivos PDF.","error");
                    $("#emb").hide();
                    $("#ruta_memo").val('');
                }else{
                    if(fileSize > 2000000){
                        swal("", "El archivo no debe ser mayor de 2MB.","error");
                        $("#emb").hide();
                    }
                }
            });//fin change rutamemo

            $("#id_tipo_equipo").change(function(){
                var tipo = $(this).val();
                var datos = {
                    _token: $("input[name='_token']").val(),
                    id_tipo_equipo: tipo,
                };

                $.ajax({
                    url: '/asignacion/buscartipoequipo',
                    method: 'get',
                    dataType:'json',
                    data: datos,
                }).done(function(data){
                    //console.log(data);
                    $("#id_invequipo").empty();
                    $("#id_invequipo").append('<option>Seleccione...</option>');
                    $.each(data, function(id, value){ 
                        $("#id_invequipo").append('<option value="'+value.id_invequipo+'">'+value.modelo+'</option>');                                
                    });
                });
            });

           

        });//fin  .ready
    </script>
    
    <br>
    <h2>Formulario - Asignación</h2>
    <br>
    <div style="width:600px">    
        <form action="/asignacion/create" method="post" enctype="multipart/form-data">  
            @csrf 
            <div class="input-group" style="padding-bottom:8px">
                <label for="" class="col-3">Memo Solicitud</label>
                <input type="file" accept=".pdf" class="form-control col-8" name="ruta_memo" id="ruta_memo" placeholder="Memoramdum Solicitud" value="{{old('ruta_memo')}}">
            </div>
            @error('ruta_memo')
            <div class="col text-danger">{{ $message }}</div>
            @enderror                     
            <div class="input-group" style="padding-bottom:8px">
                <label for="cedulafun" class="col-3">Funcionario</label>
                <input type="text" name="cedulafun" id="cedulafun" placeholder="Cedula Funcionario" class="form-control col-8 numeros" maxlength="8" value="{{old('cedulafun')}}">
                <input type="hidden" name="id_funcionario" id="id_funcionario" style="display;none">
                <span class="text-success col" id="btnfun" style="max-width: 40px; border-radius:18px" title="Datos del Equipo"><i class="fa-solid fa-eye" style="font-size: 25px; display:flex; text-align:center; justify-content:center"></i></span>
            </div> 
            @error('id_funcionario')
                <div class="col text-danger">{{ $message }}</div>
            @enderror
            <div class="input-group" style="padding:5px">
                <label for="Tipo de  Equipo" class="col-3">Tipo de  Equipo</label>
                <select name="id_tipo_equipo" id="id_tipo_equipo" class="form-control col-8">
                    <option value="">Seleccione...</option>
                    @foreach($tipos as $tipo)
                        <option value="{{$tipo->id_tipo_equipo}}">{{ $tipo->tipo_equipo }}</option>
                    @endforeach
                </select>
            </div>           
            <div class="input-group" style="padding-bottom:4px">
                <label for="id_invequipo" class="col-3">Equipo</label>
                <select name="id_invequipo" id="id_invequipo" class="form-control col-8">
                    <option value="">Seleccione...</option>                    
                </select>
                <span class="text-success col" id="btneq" style="max-width: 40px; border-radius:18px" title="Datos del Equipo"><i class="fa-solid fa-eye" style="font-size: 25px; display:flex; text-align:center; justify-content:center"></i></span>
            </div>
            @error('id_invequipo')
                <div class="col text-danger">{{ $message }}</div>
            @enderror 
            <div class="input-group" style="padding:5px">
                <label for="fecha_asignacion" class="col-3">Fecha</label>
                <input type="date" name="fecha_asignacion" id="fecha_asignacion" class="form-control col-8"  placeholder="Fecha de asignacion" value="<?php echo date("Y-m-d"); ?>">
            </div>
            @error('fecha_asignacion')
                <div class="col text-danger">{{ $message }}</div>
            @enderror                       
            <div class="input-group" style="padding-bottom:4px">
                <label for="id_estatu_asignacion" class="col-3">Estatus</label>
                <select name="id_estatu_asignacion" id="id_estatu_asignacion" class="form-control col-8">
                    <option value="">Seleccione...</option>
                    @foreach($estatus as $estatu)
                        <option value="{{$estatu->id_estatu_asignacion}}">{{$estatu->estatu_asignacion}}</option>
                    @endforeach
                </select>
                <span class="btn btn-success col" id="btneq" style="max-width: 40px; border-radius:18px" title="Datos del Equipo"><i class="fa-solid fa-eye" style="font-size: 25px; display:flex; text-align:center; justify-content:center"></i></span>
            </div>
            @error('id_estatu_asignacion')
                <div class="col text-danger">{{ $message }}</div>
            @enderror 
            <div class="input-group" style="padding:5px">
                <label for="usuario" class="col-3">Usuario</label>
                <div class="form-control col-8">{{ session('usuario') }}</div>
                <input type="hidden" name="usuario" id="usuario" class="form-control col-8 numeros" maxlength="5" placeholder="Usuario" value="{{ session('usuario') }}">
            </div>
            @error('usuario')
                <div class="col text-danger">{{ $message }}</div>
            @enderror 
            <br>
            <div>
                <center>
                    <button type="submit" class="btn btn-success" style="width:250px; height:40px"><i class="fa fa-floppy-o">Guardar</i></button>                        
                </center>
            </div>
        </form>
    </div>

    <!-- Modal funcionario-->
    <div class="modal fade" id="ModalFuncionario"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos del Funcionario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    
                    <div id="datosfun" class="form-control col" style="color:#000"></div>
                </div>
            </div>
            <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal"><i class="fa-solid fa-check"></i>OK</button>                
                </center>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal inventequipo-->
    <div class="modal fade" id="ModalEquipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos del Equipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <div id="datosinvent" class="form-control col" style="color:#000    "></div>
                </div>
            </div>   
            <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal"><i class="fa-solid fa-check"></i>OK</button>                
                </center>
            </div>      
        </div>
    </div>
    </div>
</center>
@endsection