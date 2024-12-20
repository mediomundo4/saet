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
            $('#datostbl').DataTable({    
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
            
        })

        function modificarestatu(id){
            $("#id_asignacion").val(id);
            $("#estatusModal").modal('show');
        }

        function abrirmemo(ruta){
            if(ruta != ''){
                var url = '../../archivos/asignacion/';
                window.open(url+ruta);
            }
        }
    </script>
    <div>
        <style>
            th{
                text-align:center;
                align-items:center;
            }
        </style>
        
        <h2>Listado - Asignaciones</h2><span style=""></span>
        <br>
        <div style="align-item:center; max-width:600px; display:table;">           
            <table id="datostbl" class="table table-bordered table-striped">
                <thead class="bg-primary">
                    <th style="text-align:center; color:#fff">Datos Funcionario</th>
                    <th style="text-align:center; color:#fff">Piso / Dpto / Dependencia</th>
                    <td style="text-align:center; color:#fff">Tipo equipo</td>
                    <td style="text-align:center; color:#fff">Modelo</td>
                    <td style="text-align:center; color:#fff">Procesador</td>
                    <td style="text-align:center; color:#fff">Memoria Ram</td>
                    <td style="text-align:center; color:#fff">Disco Duro</td>
                    <td style="text-align:center; color:#fff">Sistema Operativo</td>
                    <th style="text-align:center; color:#fff">Fecha Asignacion</th>
                    <th style="text-align:center; color:#fff">Estatus</th>
                    <th style="text-align:center; color:#fff">Usuario</th>
                    <th style="text-align:center; color:#fff">Accion</th>
                </thead>
                <tbody>
                    @foreach($asignaciones as $asignacion)
                        <tr>                        
                            <td style="text-align:center">
                                {{ $asignacion->cedulafun }}<br>
                                {{ $asignacion->nombrefun }} {{ $asignacion->apellidofun }}
                            </td>
                            <td style="text-align:center">
                                Piso {{ $asignacion->piso }} <br> {{ $asignacion->dependencia }} <br>{{ $asignacion->departamento }}
                            </td>
                            <td style="text-align:center">{{ $asignacion->tipo_equipo }}</td>
                            <td style="text-align:center">{{ $asignacion->modelo }}</td>
                            <td style="text-align:center">{{ $asignacion->procesador }}</td>
                            <td style="text-align:center">{{ $asignacion->memoria }}</td>
                            <td style="text-align:center">{{ $asignacion->unidad_disco }}</td>
                            <td style="text-align:center">{{ $asignacion->sistema_operativo }}</td>
                            <td style="text-align:center">{{ $asignacion->fecha_asignacion }}</td>
                            <td style="text-align:center">{{ $asignacion->estatu_asignacion }}</td>
                            <td style="text-align:center">{{ $asignacion->usuario }}</td>                                               
                            <td style="text-align:center">
                                <span class="btn btn-success " title="Modificar estatus asignacion" onclick="modificarestatu({{$asignacion->id_asignacion}})"><i style="font-size:28px" class="fa-solid fa-refresh"></i></span>                                    
                                @if($asignacion->ruta_memo != '')
                                    <span class="btn btn-danger" onclick="abrirmemo('{{$asignacion->ruta_memo}}')"><i class="fa fa-file-pdf-o" style="font-size:28px"></i></span>
                                @endif
                            </td>                                               
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <!-- Modal MODIFICAR ESTATUS-->
    <div class="modal fade" id="estatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cambiar Estatus Asignación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="/asignacion/modificarstatu" method="post">
                @csrf
                <div class="input-group">
                    <label for="" class="col-4">Estatus Asignacion</label>
                    <select name="id_estatu_asignacion" id="id_estatu_asignacion" class="form-control col">
                        <option value="">Seleccione...</option>
                        @foreach($estatus as $estatu)
                            <option value="{{ $estatu->id_estatu_asignacion }}">{{ $estatu->estatu_asignacion }}</option>
                        @endforeach
                        <input type="hidden" name="id_asignacion" id="id_asignacion">
                    </select>
                </div>
                <div>
                    <center>
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-o"></i> Actualizar</button>
                    </center>
                </div>
            </form>
        </div>
        <div class="modal-footer">

        </div>
        </div>
    </div>
    </div>
    </center>
@endsection