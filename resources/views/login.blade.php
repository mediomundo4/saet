<title>SAET</title>
<link href="{{ asset('js/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="{{ asset('js/jquery-1.9.1.js') }}"></script>
<script src="{{ asset('js/bootstrap-5.0.2-dist/js/bootstrap.min.js') }}" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="{{ asset('js/fontawesome.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<style>
    body{
        background: #0264d6; /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover,  #0264d6 1%, #1c2b5a 100%); /* FF3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(1%,#0264d6), color-stop(100%,#1c2b5a)); /* Chrome,Safari4+ */
        background: -webkit-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); /* Chrome10+,Safari5.1+ */
        background: -o-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); /* Opera 12+ */
        background: -ms-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); /* IE10+ */
        background: radial-gradient(ellipse at center,  #0264d6 1%,#1c2b5a 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0264d6', endColorstr='#1c2b5a',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
        height:calc(100vh);
        width:100%;
    }
    .clearfix {
        *zoom: 1;

        &:before,
        &:after {
            content: ' ';
            display: table;
        }
        &:after {
            clear: both;
        }
    }

    .logo{
        color:#fff;
        font-size:50px;
        line-height: 125px;
    }

    input {
        border: none;
        font-family: 'Open Sans', Arial, sans-serif;
        font-size: 14px;
        line-height: 1.5em;
        padding: 0;
        -webkit-appearance: none;
    }
</style>
<center>   

    <br><br><br><br><br><br><br>
@if ($message = Session::get('success'))
<script>
    $(document).ready(function(){
        swal("Bienvenido a SAET",'success');        
    })
</script>
@endif

@if ($message = Session::get('error'))
<script>
    $(document).ready(function(){
        swal("Usuario o clave invalida.");        
    })
</script>
@endif 
    <div class="row" style="width:600px"> 
        <div class="col-6">
            <h3 style="color:#fff; font-size:18px">Sistema de Asignación <br>de Equipos Tecnologicos</h3><br>
            <form action="/login/create" method="get">
            @method('get')
            @csrf
                <div class="row input-group">
                    <span class="fa fa-user col-2 input-group-text"></span>
                    <input type="text" class="form-control col" name="usuario" placeholder="Usuario" title="Inserte el Usuario" required>
                </div>
                <div>&nbsp;</div>
                <div class="row input-group">
                    <span class="fa fa-lock col-2 input-group-text"></span>
                    <input type="password" class="form-control col" name="clave" placeholder="Clave" title="Inserte la Clave" required>
                </div>
                <div>
                    <center>
                        <a href="" class="" style="cursor:pointer; color:white">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </center>
                </div>
                <div class="clearfix"></div>
                <div>&nbsp;</div>
                <div>
                    <center>
                        <input type="submit" class="btn btn-dark btn-lg" style="width:100px" value="Entrar">                        
                    </center>
                </div>                
            </form>
        </div>
        <div class="col-6 logo">            
            <img src="{{asset('img/logointt.jpgx') }}" alt="" style="width:350px; height:255px; display:flex; justify-content:center; text-align:center; border-radius: 12px">
        </div>       
    </div>
</center>
</div>
