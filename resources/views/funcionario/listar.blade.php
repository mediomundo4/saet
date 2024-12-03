@extends('layout.header')

@section('contenido')

  @if (session('success'))
      <script>
        swal("","{{session('success')}}","success");
      </script>
  @endif
  <div>
    <link rel="stylesheet" href="{{ asset('js/alertify.js/themes/alertify.core.css') }}">
    <link rel="stylesheet" href="{{ asset('js/alertify.js/themes/alertify.default.css') }}">
    <center>
      
      <br/><br/>
      <h2>Listado - Funcionarios</h2><span style=""></span>
      
      <div style="align-items:center; max-width:600px; display:table; min-width:250px">
          <table id="funcionarios" class="table table-bordered table-striped" >
            <thead class="bg-primary">
              <tr>
                <th style="color:#fff">Cedula</th>
                <th style="color:#fff">Nombre / Apellido</th>
                <th style="color:#fff">Telefono</th>
                <th style="color:#fff">Correo Personal</th>
                <th style="color:#fff">Correo Institucional</th>
                <th style="color:#fff">Piso</th>
                <th style="color:#fff">Departamento</th>
                <th style="color:#fff">Dependencia</th>
                <th style="color:#fff">Accion</th>
              </tr>
            </thead>
            <tbody>
              
              @foreach($funcionarios as $funcionario)
                @if($funcionario == '')
                  <tr>
                    <td colspan="8">No se encontro ningun funcionario.</td>
                  </tr>
                @else
                  <tr>
                    <td style="text-align:center; color:#000">{{ $funcionario->cedulafun }}</td>
                    <td style="text-align:center; color:#000">{{ $funcionario->nombrefun }}<br>{{ $funcionario->apellidofun }}</td>
                    <td style="text-align:center; color:#000">{{ $funcionario->telefono }}</td>
                    <td style="text-align:center; color:#000">{{ $funcionario->correo_personal }}</td>
                    <td style="text-align:center; color:#000">{{ $funcionario->correo_inst }}</td>
                    <td style="text-align:center; color:#000">{{ $funcionario->piso }}</td>  
                    <td style="text-align:center; color:#000">{{ $funcionario->dependencia }}</td>
                    <td style="text-align:center; color:#000">{{ $funcionario->departamento }}</td>
                    <td style="text-align:center; color:#000">                    
                      <span class="btn btn-success fa fa-refresh" onclick="actualizar({{ $funcionario->id_funcionario }})"></span>
                      <!--  <span class="btn btn-danger fa fa-trash" onclick="eliminar({{ $funcionario->id_funcionario }})"></span> -->
                    </td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
      </div>

      

  <!-- Modal de bootstrap -->
  <div class="modal fade" id="modificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="modal-title" id="exampleModalLabel" style="color: #fff">Actualizar - Funcionario</h5>
          <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/funcionario/update" method="get">                
              @csrf
              <div class="input-group">
                  <label for="" class="col-sm-3">Cedula</label>
                  <div class="col">
                      <input type="text" class="form-control" placeholder="Cedula" name="cedulafun" id="cedulafun" pattern="[0-9]+" required="required" />
                      <input type="hidden" name="id_funcionario" id="id_funcionario" required="required" />
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
              <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i>Guardar Cambios</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Cancelar</button>
          </form>    
        </div>        
      </div>
    </div>
  </div>

    </center>
  </div>

  <script src="{{ asset('js/jquery.ajaxq-0.0.1.js') }}"></script>
  <script src="{{ asset('js/alertify.js/lib/alertify.js') }}"></script>
  <script>  
      $('#funcionarios').DataTable({    
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
      }); //cambia la el idioma a español


      function actualizar(id){
        var datos = {id_funcionario: id};
        $.ajax({
            url: '/funcionario/edit',
            method: 'get',
            data: datos,
        }).done(function(data){
            var dataJson = JSON.parse(data);
                                                                 
            $("#id_funcionario").val(dataJson[0].id_funcionario);
            $("#nombrefun").val(dataJson[0].nombrefun);
            $("#apellidofun").val(dataJson[0].apellidofun);
            $("#cedulafun").val(dataJson[0].cedulafun);
            $("#usuario_dominio").val(dataJson[0].usuario_dominio);
            $("#correo_personal").val(dataJson[0].correo_personal);
            $("#correo_inst").val(dataJson[0].correo_inst);
            $("#telefono").val(dataJson[0].telefono);
            $("#modificar").modal('show');
        });

        return false;
      }

      function eliminar(id){
        alertify.confirm("¿Desea eliminar a este funcionario?", function (e) {
            if (e) {
              var datos = {id_funcionario: id};
              $.ajax({
                  url: '/funcionario/delete',
                  method: 'get',
                  data: datos,
              }).done(function(data){
                  var dataJson = JSON.parse(data);
                  // console.log(dataJson);
                  if(dataJson.estado == 'eliminado'){
                    swal('',dataJson.msj,'success');
                    setTimeout(() => {
                      window.location='/funcionario/listar';
                    }, 3000);
                  }
              });
            } else { }
      }); 

      return false
      }

      
  </script>
@endsection 