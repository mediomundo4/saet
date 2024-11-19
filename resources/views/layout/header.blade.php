<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAET</title>
    <link rel="stylesheet" href="{{ asset('js/bootstrap-4.0.0/bootstrap.min.css') }}" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('js/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2.min.css') }}">
    <script src="{{ asset('js/jquery-1.9.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap-4.0.0/popper.min.js') }}" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap-4.0.0/bootstrap.min.js') }}" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ asset('js/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/validCampoFranz.js') }}"></script>

</head>
<body>
    
    @if (session('nombre_completo') == "") 
        echo  "<script> alert('Usted no ha iniciado sesion o su sesion se termino') </script>";
        echo  "<script> window.top.location='/'; </script>";
        exit;
    @endif  
    
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div>
      <a class="navbar-brand" href="#" style="padding-left:15px; padding-right:10px">SAET</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="nav fa-solid fa-bars"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/principal"><i class="fa fa-home"></i> principal <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="funcionario" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa-solid fa-user-tie"></i> Funcionario
            </a>
            <div class="dropdown-menu" aria-labelledby="funcionario">
            <a class="dropdown-item" href="/funcionario"><i class="fa fa-plus-circle"></i> Nuevo</a>
            <!-- <a class="dropdown-item" href="/funcionario"><i class="fa fa-plus-circle"></i> Nuevo</a> -->
            <a class="dropdown-item" href="/funcionario/listar"><i  class="fa fa-list"></i> Listado</a>         
        </div>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa-solid fa-clipboard-list"></i> Inventario De Equipos
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/inventario"><i class="fa fa-plus-circle"></i> Nuevo</a>
            <a class="dropdown-item" href="/inventario/listar"><i class="fa fa-search"></i> Consultar</a>         
            <a class="dropdown-item" href="/inventario/portipo"><i class="fa fa-search"></i> Consultar Tipo Equipo</a>         
          </div>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="asignacion" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-desktop"></i> Asignacion
          </a>
          <div class="dropdown-menu" aria-labelledby="asignacion">
            <a class="dropdown-item" href="/asignacion"><i class="fa fa-plus-circle"></i> Nueva</a>
            <a class="dropdown-item" href="/asignacion/listar"><i class="fa fa-search"></i> Consultar</a>         
          </div>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="asignacion" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-print"></i> Reportes
          </a>
          <div class="dropdown-menu" aria-labelledby="asignacion">
            <a class="dropdown-item" href="/reporte/pordpndnc"><i class="fa fa-file-text"></i> Por Departamento</a>
            <a class="dropdown-item" href="/reporte/pordpto"><i class="fa fa-file-text"></i> Por Dependencia</a>         
            <a class="dropdown-item" href="/reporte/porrngfecha"><i class="fa fa-file-text"></i> Por Rango de fechas</a>         
          </div>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="asignacion" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa-solid fa-pie-chart"></i> Graficos
          </a>
          <div class="dropdown-menu" aria-labelledby="asignacion">
            <a class="dropdown-item" href="/reporte/graficoprostatu"><i class="fa-solid fa-pie-chart"></i> Por Estatus</a>                    
          </div>
        </li>
        @if(session('perfil')== 1)
          <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="asignacion" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid fa-user-gear"></i> Usuario
            </a>
            <div class="dropdown-menu" aria-labelledby="asignacion">
              <a class="dropdown-item" href="/usuario"><i class="fa fa-plus-circle"></i> Nuevo</a>
              <a class="dropdown-item" href="/usuario/listar"><i class="fa fa-search"></i> Consultar</a>         
            </div>
          </li>
        @endif       
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="usuario" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if(session('foto') == '')
              <i class="fa fa-user-circle"></i> {{ session('nombre_completo') }}
            @else
              <?php 
                $ruta = session('foto');
                echo "<img src='../../archivos/usuarios/".$ruta."' style='width:35px; height:35px; border-radius:150px'>";
              ?>
              {{ session('nombre_completo') }}
            @endif
          </a>
          <div class="dropdown-menu" aria-labelledby="usuario">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cambiar_clave"><i class="fa fa-lock"></i> Cambiar Contraseña</a>
            @if(session('foto')==null)
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cargarimg"><i class="fa fa-camera"></i> Cargar Imagen</a>
            @endif
            <a class="dropdown-item" href="/salir"><i class="fa fa-sign-out"></i> Cerrar Sesion</a>         
          </div>
        </li>        
      </ul>      
    </div>
  </nav>
  <br>    
  <div>
  @yield('contenido')
  </div>
  <br><br>

  <script>
    
    $(document).ready(function(){
      $("#foto").hide();

      //Para escribir solo letras
      $('.letras').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú');
      //Para escribir solo numeros    
      $('.numeros').validCampoFranz('0123456789');
      
      //inicio ajax cambio de clave
      $("#frm_usuarios").submit(function(){
        var FormData = $(this).serialize();
        var clave = $("#clave").val();
        var claver = $("#repetir_clave").val();
        
        if(clave == claver){
          $.ajax({
            url: '/usuario/clave',
            method: 'post',
            data: FormData,
            dataType: 'json',
          }).done(function(data){
            //console.log(data);
            if(data.estado == 'actualizado'){
              swal('',data.msj,'success');
              $("#clave").val();
              $("#repetir_clave").val();
              $("#cambiar_clave").modal('hide');
            }
          });

          return false;
        }else{
          $("#repetir_clave").val('');
          swal('', 'Ambas claves deben ser exactamente igual.', 'error');
        }
        return false;
      }); //fin ajax cmabio de clave
    }); //fin document.ready

    //funcion para ejecutar el input file desde la img
    function explorar(){
        document.getElementById('ruta_foto').click();
        $("#nombre_arch").html("")
    }



    function obtener_arch() {      
        var archivo = $('#ruta_foto').val();
        var ext = archivo.substring(archivo.lastIndexOf("."));
        //console.log(ext);
        var fileSize = document.getElementById('ruta_foto').files[0].size;
        if(ext !== ".jpg" && ext !== ".jpeg" && ext !== ".png"){
            swal('',"Solo imagenes jpg, jpeg o png.",'error');
        }else{
            if(fileSize > 2000000){
                swal("","La imagen no debe ser mayor de 2MB.","error");
            }else{      
                var file = document.getElementById('ruta_foto').files[0];
                //console.log(file);
                if (file){
                    let reader = new FileReader();
                    reader.onload = function(event){
                        //console.log(event.target.result);
                        // $("#emb").show();
                        $("#fotoimg").attr('src', event.target.result);
                        //$("#tituloimg").hide();
                    }
                    reader.readAsDataURL(file);
                }
            }
        }
    }


  </script>
<!--Inicio mensajes de foto-->
  @if (session('successfoto'))  
      <script>
      swal("","{{session('successfoto')}}","success");
      </script>
  @endif
  @if (session('errorfoto'))  
      <script>
      swal("","{{session('errorfoto')}}","success");
      </script>
  @endif
<!--Fin mensajes de foto-->

<!-- INICIO Modal cargar imagen-->
  <div class="modal fade" id="cargarimg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <center>
            <h5 class="modal-title" id="exampleModalLabel" style="text-align:center">Cargar Imagen</h5>
          </center>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span >
          </button>  
        </div>
        <div class="modal-body">
          <center>
            <form action="/usuario/update" method="post" enctype="multipart/form-data">
              @csrf
                <div class='col-sm-12'>              
                  <a href="javascript:explorar();">
                    <div>
                      <img src="{{ asset('img/subirimg2.png') }}" id="fotoimg" title="Subir imagen" style="width:150px; height:150px; border-radius:150px;"><br />
                      <i class="fa fa-camera btn btn-primary" id="tituloimg"> seleccionar Imagen</i>
                    </div>
                  </a>              
                  <input type="file" name="ruta_foto" id="ruta_foto" acept=".jpg" style="display:none;" onchange="javascript:obtener_arch();">                  
                  <input type="hidden" name="usuario" id="usuario" value="{{ session('usuario') }}">              
                </div><br>
                <div>
                  <center>
                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>                    
                  </center>
                </div>
              </div>              
            </form>
          </center>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
<!-- FIN Modal cargar imagen-->

 <!-- INICIO Modal cambiar clave-->
<div class="modal fade" id="cambiar_clave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Clave</h5>
        
      </div>
      <div class="modal-body">
        <center>
          <form action="" method="post" id="frm_usuarios">
            @csrf
            <div class="input-group">
              <span class="input-group-text fa-solid fa-user-lock" id="basic-addon1"></span>
              <input type="password" name="clave" id="clave" class="form-control col" placeholder="Nueva Clave" required>
              <input type="hidden" name="usuario" id="usuario" value="{{ session('usuario') }}">              

            </div>
            <div class="input-group">
              <span class="input-group-text fa-solid fa-user-lock" id="basic-addon1"></span>
              <input type="password" name="repetir_clave" id="repetir_clave" class="form-control col" placeholder="Reingrese Clave" required>
            </div><br>
            <div>
              <center>
                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>                    
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa-solid fa-times"></i> Cancelar</button>
              </center>
            </div>
            
          </form>
        </center>
      </div>
      <div class="modal-footer">
          
      </div>      
    </div>
  </div>
</div>
<!-- FIN Modal cambiar clave-->

</body>
</html>

