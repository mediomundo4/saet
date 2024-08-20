@extends('layout.header')

@section('contenido')
    <center>
      @if (session('success'))
          <script>
          swal("","{{session('success')}}","success");
          </script>
      @endif

      @if (session('error'))
          <script>
          swal("","{{session('success')}}","success");
          </script>
      @endif

      <script>
        $("#foto").hide();
        function explorar(){
            document.getElementById('ruta_foto').click();
            $("#nombre_arch").html("")
        }

        function obtener_arch() {      
            var archivo = $('#ruta_foto').val();
            var ext = archivo.substring(archivo.lastIndexOf("."));
            console.log(ext);
            var fileSize = document.getElementById('ruta_foto').files[0].size;
            if(ext !== ".jpg" && ext !== ".jpeg" && ext !== ".png"){
                alert("Solo imagenes jpg, jpeg o png.");
                $("#emb").hide();
            }else{
                if(fileSize > 2000000){
                    alert("La imagen no debe ser mayor de 2MB.");
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

      <img src="{{ asset('img/form.png') }}" alt="" width="135" height="95">
      <h2>Registrar - Nuevo Usuarios</h2>      
      <div style="width:600px">
        <form action="/usuario/create" method="post" enctype="multipart/form-data">
          @csrf
          <div class='col-sm-12'>              
            <a href="javascript:explorar();">
              <div>
                <img src="{{ asset('img/subirimg2.png') }}" id="fotoimg" title="Subir imagen" style="width:150px; height:150px; border-radius:150px;"><br />
                <i class="fa fa-camera btn btn-primary" id="tituloimg"> seleccionar Imagen</i>
              </div>
            </a>              
            <input type="file" name="ruta_foto" id="ruta_foto" acept=".jpg" style="display:none;" onchange="javascript:obtener_arch();">              
          </div><br>       
          <div class="input-group">
            <lavel class="col-sm-3">Cedula</lavel>
            <input type="text" class="form-control col-sm-9" name="cedula" id="cedula" placeholder="Cedula">
          </div>
          <div class="input-group">
            <lavel class="col-sm-3">Nombre</lavel>
            <input type="text" class="form-control col-sm-9" name="nombre" id="nombre" placeholder="Nombre">
          </div>
          <div class="input-group">
            <lavel class="col-sm-3">Apellido</lavel>
            <input type="text" class="form-control col-sm-9" name="apellido" id="apellido" placeholder="Apellido">
          </div>
          <div class="input-group">
            <label class="col-sm-3">Perfil</label>
            <select name="id_perfil" id="id_perfil" class="col-sm-9 form-control">
              <option>Seleccione...</option>
              @foreach($perfiles as $perfil)
                <option value="{{$perfil->id_perfil}}">{{$perfil->perfil}}</option>
              @endforeach
            </select>
          </div>
          <div class="input-group">
            <lavel class="col-sm-3">Usuario</lavel>
            <input type="text" class="form-control col-sm-9" name="usuario" id="usuario" placeholder="Usuario">
          </div>
          <div class="input-group">
            <lavel class="col-sm-3">Clave</lavel>
            <input type="password" class="form-control col-sm-9" name="clave" id="clave" placeholder="Clave">
          </div>
          <div class="input-group">
            <lavel class="col-sm-3">Correo</lavel>
            <input type="email" class="form-control col-sm-9" name="correo" id="correo" placeholder="Correo">
          </div><br>
          <div>
            <center>
              <button type="submit" class="btn btn-success" style="width:250px; height:40px"><i class="fa fa-floppy-o">Guardar</i></button>                        
            </center>
          </div>
        </form>
      </div>
    </center>

@endsection