@extends('layout.header')

@section('contenido')    
    <center>
        @if (session('success'))
            <script>
            swal("","{{session('success')}}","success");
            </script>
        @endif
        <img src="{{ asset('img/form.png') }}" alt="" width="135" height="95">
        <br>
        <h2>Formulario - Funcionarios</h2>
        <br>
        <div style="width:600px">
            <form action="/funcionario/create" method="post">                
                @csrf
                <div class="input-group">
                    <label for="" class="col-sm-3">Cedula</label>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Cedula" name="cedulafun" id="cedulafun" pattern="[0-9]+" required="required" />
                    </div>
                </div>
                <div class="input-group">
                    <label for="" class="col-3">Nombre</label>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Nombre" name="nombrefun" id="nombrefun" required="required" />
                    </div>
                </div>
                <div class="input-group">
                    <label for="" class="col-3">Apellido</label>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Apellido" name="apellidofun" id="apellidofun" required="required" />
                    </div>
                </div>                
                <div class="input-group">
                    <label for="" class="col-3">Usuario Dominio</label>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Usuario de Dominio" name="usuario_dominio" id="usuario_dominio" required="required" />
                    </div>
                </div>
                <div class="input-group">
                    <label for="" class="col-3">telefono</label>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Telefono" name="telefono" id="telefono" required="required" />
                    </div>
                </div>
                <div class="input-group">
                    <label for="" class="col-3">Correo Personal</label>
                    <div class="col">
                        <input type="email" class="form-control" placeholder="Correo Personal" name="correo_personal" id="correo_personal" required="required" />
                    </div>
                </div>
                <div class="input-group">
                    <label for="" class="col-3">Correo Institucional</label>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Correo Institucional" name="correo_inst" id="correo_inst" required="required" />
                    </div>
                </div>                
                <br>
                <div>
                    <center>
                        <button type="submit" class="btn btn-success" style="width:250px; height:40px"><i class="fa fa-floppy-o">Guardar</i></button>                        
                    </center>
                </div>
            </form>
        </div>
    </center>
    <script src="{{ asset('public/js/jquery.maskedinput-master/src/jquery.maskedinput.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#cedulafun").mask("99.999.999");

            $("#cedulafun").blur(function(){
                var datos = {cedulafun: $("#cedulafun").val()};
                $.ajax({
                  url: '/funcionario/buscar',
                  method: 'get',
                  data: datos,
              }).done(function(data){
                  var dataJson = JSON.parse(data);
                  // console.log(dataJson);
                  if(dataJson.estado == 'encontrado'){
                    swal('',dataJson.msj,'error');
                    $("#cedulafun").val('');
                  }
              });
            });

            $("#usuario_dominio").blur(function(){
                var userdom = $(this).val();
                //alert(userdom);
                $("#correo_inst").val(userdom+'@intt.gob.ve');
            });
        })
    </script>
@endsection