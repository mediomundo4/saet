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
                $("#btn_newdpto").click(function(){
                    var dpdnc = $("#id_dependencia").val();
                    if(dpdnc == ''){
                        swal('', 'Debe seleccionar primero un departamento para poder registrar una dependencia', 'info');
                    }else{
                        $("#iddependencia").val(dpdnc);
                        $("#ModalDpto").modal('show');
                    }   
                });
                //data-toggle="modal" data-target="#ModalDpdnc"
                $("#btn_newdepen").click(function(){
                    var piso = $("#id_piso").val();
                    if(piso == ''){
                        swal('', 'Debe seleccionar primero un piso para poder registrar un departamento', 'info');
                    }else{
                        $("#idpiso").val(piso);
                        $("#ModalDpdnc").modal('show');
                    }
                });

                $("#frm_dpto").submit(function(){
                    var dpdnc = $("#id_dependencia").val();
                    
                    if(dpdnc == ''){
                        swal('', 'Debe seleccionar un departamento.', 'error' )
                    }else{

                        var FormData = $(this).serialize();
                        $.ajax({
                            url: '/funcionario/newdpto',
                            data: FormData,
                            method: 'post',
                            dataType: 'json'
                        }).done(function(data){ //console.log(data);
                            $("#departamento").val('')
                            $("#id_departamento").append('<option value="'+data.id+'" selected >'+data.departamento+'</option>');
                            $("#ModalDpto").modal('hide');
                        });
                       
                    }
                    return false;
                });

                $("#frm_dpdnc").submit(function(){
                    var FormData = $(this).serialize();
                        $.ajax({
                            url: '/funcionario/newddpdnc',
                            data: FormData,
                            method: 'post',
                            dataType: 'json'
                        }).done(function(data){ //console.log(data);
                            if(data.estado == 'insertado'){
                                $("#dependencia").val('');
                                $("#id_dependencia").append('<option value="'+data.id+'" selected >'+data.dependencia+'</option>');
                                $("#ModalDpdnc").modal('hide');
                            }
                        });
                    return false;
                });

                $("#id_piso").change(function(){
                    var piso = $(this).val();
                    var datos = {
                        _token: $("input[name='_token']").val(),
                        id_piso: piso                        
                    };

                    $.ajax({
                        url: '/funcionario/buscarpiso',
                        method: 'get',
                        data: datos,
                        dataType: 'json'
                    }).done(function(data){
                        //console.log(data);
                        $("#id_dependencia").empty();
                        $("#id_dependencia").append('<option>Seleccione...</option>');
                        $.each(data, function(id, value){                        
                            $("#id_dependencia").append('<option value="'+value.id_dependencia+'">'+value.dependencia+'</option>');
                        });
                    });
                });

                $("#id_dependencia").change(function(){
                    var iddep = $(this).val();
                    var datos = {
                        _token: $("input[name='_token']").val(),
                        id_dependencia: iddep                        
                    };
                    $.ajax({
                        url: '/funcionario/buscardpdnc',
                        method: 'get',
                        data: datos,
                        dataType: 'json'
                    }).done(function(data){
                        //console.log(data);
                        $("#id_departamento").empty();
                        $("#id_departamento").append('<option>Seleccione...</option>');
                        $.each(data, function(id, value){                        
                            $("#id_departamento").append('<option value="'+value.id_departamento+'">'+value.departamento+'</option>');
                        });
                    });
                });

                $("#usuario_dominio").blur(function(){
                    var userdom = $(this).val();
                    $("#correo_inst").val(userdom+"@intt.gob.ve");
                });

                $("#cedulafun").blur(function(){
                    var datos = {
                        _token: $("input[name='_token']").val(),
                        cedulafun: $(this).val()                        
                    };
                    $.ajax({
                        url: '/funcionario/buscar',
                        method: 'get',
                        data: datos,
                        dataType: 'json'
                    }).done(function(data){
                        if(data.estado == 'encontrado'){
                            $(this).val('');
                            swal('', data.msg, 'error');
                        }
                    });
                });
            });///fin .ready
        </script>
        <br>
        <h2>Formulario - Funcionarios</h2>
        <br>
        <div style="width:600px">
            <form action="/funcionario/create" method="post">                
                @csrf
                <div class="input-group" style="padding:5px">
                    <label for="" class="col-sm-4">Cedula</label>
                    <input type="text" class="form-control col numeros" maxlength="8" placeholder="Cedula" name="cedulafun" id="cedulafun" value="{{old('cedulafun')}}"   />
                </div>
                @error('cedulafun')
                    <div class="col text-danger">{{ $message }}</div>
                @enderror
                <div class="input-group" style="padding:5px">
                    <label for="" class="col-sm-4">Nombre</label>
                    <input type="text" class="form-control col letras" maxlength="22" placeholder="Nombre" name="nombrefun" id="nombrefun" value="{{old('nombrefun')}}"  />
                </div>
                @error('nombrefun')
                    <div class="col text-danger">{{ $message }}</div>
                @enderror
                <div class="input-group" style="padding:5px">
                    <label for="" class="col-sm-4">Apellido</label>
                    <input type="text" class="form-control col letras" maxlength="25" placeholder="Apellido" name="apellidofun" id="apellidofun" value="{{old('apellidofun')}}" />
                </div>
                @error('apellidofun')
                    <div class="col text-danger">{{ $message }}</div>
                @enderror
                
                <div class="input-group" style="padding:5px">
                    <label for="id_piso" class="col-sm-4">Piso</label>
                    <select name="id_piso" id="id_piso" class="form-control col">
                        <option value="">Seleccione...</option>
                        @foreach($pisos as $piso)
                            <option value="{{$piso->id_piso}}">{{$piso->piso}}</option>
                        @endforeach
                    </select>   
                </div>
                @error('id_piso')
                    <div class="col text-danger">{{ $message }}</div>
                @enderror

                <div class="input-group" style="padding:5px">
                    <label for="id_dependencia" class="col-sm-4">Departamento</label>
                    <select name="id_dependencia" id="id_dependencia" class="form-control col">
                        <option value="">Seleccione...</option>
                        <!-- @foreach($dependencias as $dependencia)
                            <option value="{{$dependencia->id_dependencia}}">{{$dependencia->dependencia}}</option>
                        @endforeach -->
                    </select>   
                    <span class="btn btn-success col" id="btn_newdepen" style="max-width: 40px; border-radius:18px" title="Registrar nuevo Modelo"><i class="fa-solid fa-plus-circle" style="font-size: 25px; display:flex; text-align:center; justify-content:center"></i></span>
                </div>
                @error('id_dependencia')
                    <div class="col text-danger">{{ $message }}</div>
                @enderror    

                <div class="input-group" style="padding:5px">
                    <label for="id_departamento" class="col-sm-4">Dependencia</label>
                    <select name="id_departamento" id="id_departamento" class="form-control col">
                        <option value="">Seleccione...</option>
                    </select>   
                    <span class="btn btn-success col" id="btn_newdpto" style="max-width: 40px; border-radius:18px"><i class="fa-solid fa-plus-circle" style="font-size: 25px; display:flex; text-align:center; justify-content:center"></i></span>
                </div>
                @error('id_departamento')
                    <div class="col text-danger">{{ $message }}</div>
                @enderror
                <div class="input-group" style="padding:5px">
                    <label for="id_cargo" class="col-sm-4">Cargo</label>
                    <select name="id_cargo" id="id_cargo" class="form-control col">
                        <option value="">Seleccione...</option>
                        @foreach($cargos as $cargo)
                            <option value="{{$cargo->id_cargo}}">{{$cargo->cargo}}</option>
                        @endforeach
                    </select>
                </div>
                @error('id_cargo')
                    <div class="col text-danger">{{ $message }}</div>
                @enderror   
                  

                <div class="input-group" style="padding:5px">
                    <label for="" class="col-sm-4">Usuario Dominio</label>
                    <input type="text" class="form-control col" maxlength="17" placeholder="Usuario de Dominio" name="usuario_dominio" id="usuario_dominio" value="{{old('usuario_dominio')}}" />
                </div>
                @error('usuario_dominio')
                    <div class="col text-danger">{{ $message }}</div>
                @enderror
                <div class="input-group" style="padding:5px">
                    <label for="" class="col-sm-4">telefono</label>
                    <input type="text" class="form-control col numeros" maxlength="11" placeholder="Telefono" name="telefono" id="telefono" value="{{old('telefono')}}" />
                </div>
                @error('telefono')
                    <div class="col text-danger">{{ $message }}</div>
                @enderror
                <div class="input-group" style="padding:5px">
                    <label for="" class="col-sm-4">Correo Personal</label>
                    <input type="email" class="form-control col" maxlength="32" placeholder="Correo Personal" name="correo_personal" id="correo_personal" value="{{old('correo_personal')}}" />
                </div>
                @error('correo_personal')
                    <div class="col text-danger">{{ $message }}</div>
                @enderror
                <div class="input-group" style="padding:5px">
                    <label for="" class="col-sm-4">Correo Institucional</label>
                    <input type="text" class="form-control col" maxlength="28" placeholder="Correo Institucional" name="correo_inst" id="correo_inst" value="{{old('correo_inst')}}" />
                </div>
                @error('correo_inst')
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

        <!-- inicio Modal Dependencia -->
        <div class="modal fade" id="ModalDpdnc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo departamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="frm_dpdnc">
                            @csrf
                            <div class="input-group">
                                <label for="" class="col-4">Departamento</label>
                                <textarea name="dependencia" id="dependencia" class="col form-control letras"  cols="30" rows="3" placeholder="Departamento" required></textarea>
                            </div>
                            
                            <br>                   
                            <div>
                                <center>
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-o"></i> Guardar</button>
                                </center>
                            </div>
                        </form>
                    </div>                
                </div>
            </div>
        </div>
        <!-- fin Modal Dependencia -->

        <!--Inicio Modal Departamento -->
        <div class="modal fade" id="ModalDpto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar nueva dependencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <form action="" method="post" id='frm_dpto'>
                            @csrf
                            <div class="input-group">
                                <label for="" class="col-4">Dependencia</label>
                                <textarea name="departamento" id="departamento" cols="30" class="col form-control letras" rows="3" placeholder="Dependencia" required></textarea>
                                <input type="hidden" name="iddependencia" id="iddependencia">
                                <input type="hidden" name="idpiso" id="idpiso">
                            </div>
                            
                            <br>
                            <div>
                                <center>
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-o"></i> Guardar</button>
                                </center>
                            </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
        <!--Fin Modal Departamento -->

        <!--Inicio Modal Cargo -->
        <div class="modal fade" id="ModalCargo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo Cargo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <form action="" method="post" id='frm_dpto'>
                            @csrf
                            <div class="input-group">
                                <label for="cargo" class="col-4">Cargo</label>
                                <textarea name="cargo" id="cargo" cols="30" class="col form-control letras" maxlength="45" rows="3" placeholder="Cargo" required></textarea>
                                <input type="hidden" name="iddependencia" id="iddependencia">
                            </div>
                           
                            <br>
                            <div>
                                <center>
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-o"></i> Guardar</button>
                                </center>
                            </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
        <!--Fin Modal Cargo -->
    </center>
@endsection