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
                        swal('', 'Debe seleccionar primero una dependencia para poder registrar un departamento', 'info');
                    }else{
                        
                    }   
                });

                // $("#frm_dpto").submit(function(){
                    
                    
                //     return false;
                // });

                // $("#frm_dpdnc").submit(function(){
                    
                // });
            })
        </script>
        <br>
        <h2>Formulario - Funcionarios</h2>
        <br>
        <div style="width:600px">
            <form action="/funcionario/create" method="post">                
                @csrf
                <div class="input-group" style="padding:5px">
                    <label for="" class="col-sm-4">Cedula</label>
                    <input type="text" class="form-control col" placeholder="Cedula" name="cedulafun" id="cedulafun" pattern="[0-9]+" required="required" />
                </div>
                @error('cedulafun')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror
                <div class="input-group" style="padding:5px">
                    <label for="" class="col-sm-4">Nombre</label>
                    <input type="text" class="form-control col" placeholder="Nombre" name="nombrefun" id="nombrefun" required="required" />
                </div>
                @error('nombrefun')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror
                <div class="input-group" style="padding:5px">
                    <label for="" class="col-sm-4">Apellido</label>
                    <input type="text" class="form-control col" placeholder="Apellido" name="apellidofun" id="apellidofun" required="required" />
                </div>
                @error('apellidofun')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror
                <div class="input-group" style="padding:5px">
                    <label for="id_dependencia" class="col-sm-4">Dependencia</label>
                    <select name="id_dependencia" id="id_dependencia" class="form-control col">
                        <option value="">Seleccione...</option>
                    </select>   
                    <span class="btn btn-success col" id="btn_newdepen" style="max-width: 40px; border-radius:18px" data-toggle="modal" data-target="#ModalDpdnc" title="Registrar nuevo Modelo"><i class="fa-solid fa-plus-circle" style="font-size: 25px; display:flex; text-align:center; justify-content:center"></i></span>
                </div>
                @error('id_dependencia')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror     
                <div class="input-group" style="padding:5px">
                    <label for="id_departamento" class="col-sm-4">Departamento</label>
                    <select name="id_departamento" id="id_departamento" class="form-control col">
                        <option value="">Seleccione...</option>
                    </select>   
                    <span class="btn btn-success col" id="btn_newdpto" style="max-width: 40px; border-radius:18px"><i class="fa-solid fa-plus-circle" style="font-size: 25px; display:flex; text-align:center; justify-content:center"></i></span>
                </div>
                @error('id_departamento')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror 
                <div class="input-group" style="padding:5px">
                    <label for="id_piso" class="col-sm-4">Piso</label>
                    <select name="id_piso" id="id_piso" class="form-control col">
                        <option value="">Seleccione...</option>
                    </select>   
                </div>
                @error('id_piso')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror                     
                <div class="input-group" style="padding:5px">
                    <label for="" class="col-sm-4">Usuario Dominio</label>
                    <input type="text" class="form-control col" placeholder="Usuario de Dominio" name="usuario_dominio" id="usuario_dominio" required="required" />
                </div>
                @error('usuario_dominio')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror
                <div class="input-group" style="padding:5px">
                    <label for="" class="col-sm-4">telefono</label>
                    <input type="text" class="form-control col" placeholder="Telefono" name="telefono" id="telefono" required="required" />
                </div>
                @error('telefono')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror
                <div class="input-group" style="padding:5px">
                    <label for="" class="col-sm-4">Correo Personal</label>
                    <input type="email" class="form-control col" placeholder="Correo Personal" name="correo_personal" id="correo_personal" required="required" />
                </div>
                @error('correo_personal')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror
                <div class="input-group" style="padding:5px">
                    <label for="" class="col-sm-4">Correo Institucional</label>
                    <input type="text" class="form-control col" placeholder="Correo Institucional" name="correo_inst" id="correo_inst" required="required" />
                </div>
                @error('correo_inst')
                    <div class="col text-danger">*Este campo es obligatorio.</div>
                @enderror                
                <br>
                <div>
                    <center>
                        <button type="submit" class="btn btn-success" style="width:250px; height:40px"><i class="fa fa-floppy-o">Guardar</i></button>                        
                    </center>
                </div>
            </form>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ModalDpdnc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registrar nueva Dependencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="frm_dpdnc">
                            @csrf
                            <div class="input-group">
                                <label for="" class="col-3">Dependencia</label>
                                <input type="text" class="col form-control" name="dependencia" id="dependencia" placeholder="Dependencia">
                            </div> <br>                   
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

        <!-- Modal -->
        <div class="modal fade" id="ModalDpto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo Departamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <form action="" method="post" id='frm_dpto'>
                            @csrf
                            <div class="input-group">
                                <label for="" class="col-3">Departamento</label>
                                <input type="text" class="col form-control" name="departamento" id="departamento" placeholder="Departamento" required>
                            </div><br>
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

    </center>
    
@endsection