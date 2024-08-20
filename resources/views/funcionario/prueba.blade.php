<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prueba subir imagen</title>
    <link rel="stylesheet" href="{{ asset('js/bootstrap-4.0.0/bootstrap.min.css') }}" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <br><br>
    <center>
        <div class='container' style="background-color:silver; padding:20px">
            <h1>Cargar Imagen</h1><br clear="all"><br clear="all">
            <a href="javascript:explorar();">
                <div>
                    <img src="{{ asset('img/subirimg.png') }}" id="fotoimg" title="Subir imagen" style="width:220px; height:220px; border-radius:150px;"><br clear="all" >
                    <div id="foto" "></div>
                    Subir Imagen
                </div>
            </a>
            <div id="nombre_arch">

            </div>
            <input type="file" name="f_subir" id="f_subir" acept=".jpeg" style="display:none;" onchange="javascript:obtener_arch();">
            <br clear="all"><br clear="all">
        </div>
    </center>

    <script src="{{ asset('js/jquery-1.9.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap-4.0.0/popper.min.js') }}" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap-4.0.0/bootstrap.min.js') }}" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $("#foto").hide();
        function explorar(){
            document.getElementById('f_subir').click();
            $("#nombre_arch").html("")
        }
        
        function obtener_arch() {      
            var archivo = $('#f_subir').val();
            var ext = archivo.substring(archivo.lastIndexOf("."));
            console.log(ext);
            var fileSize = document.getElementById('f_subir').files[0].size;
            if(ext !== ".jpg" && ext !== ".jpeg" && ext !== ".png"){
                alert("Solo imagenes jpg,jpeg o png.");
                $("#emb").hide();
            }else{
                if(fileSize > 2000000){
                    alert("La imagen no debe ser mayor de 2MB.");
                }else{      
                    var file = document.getElementById('f_subir').files[0];
                    //console.log(file);
                    if (file){
                        let reader = new FileReader();
                        reader.onload = function(event){
                            //console.log(event.target.result);
                            // $("#emb").show();
                            $("#fotoimg").attr('src', event.target.result);
                        }
                        reader.readAsDataURL(file);
                    }
                }
            }
        }

       

    </script>
</body>
</html>