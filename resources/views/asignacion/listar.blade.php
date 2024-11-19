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
                <thead class="table-dark">
                    <th style="text-align:center">Datos Funcionario</th>
                    <th style="text-align:center">Piso / Dpto / Dependencia</th>
                    <td style="text-align:center">Tipo equipo</td>
                    <td style="text-align:center">Modelo</td>
                    <td style="text-align:center">Procesador</td>
                    <td style="text-align:center">Memoria Ram</td>
                    <td style="text-align:center">Disco Duro</td>
                    <td style="text-align:center">Sistema Operativo</td>
                    <th style="text-align:center">Fecha Asignacion</th>
                    <th style="text-align:center">Cantidad</th>
                    <th style="text-align:center">Estatus</th>
                    <th style="text-align:center">Usuario</th>
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
                            <td style="text-align:center">{{ $asignacion->cantidad_asignacion }}</td>
                            <td style="text-align:center">{{ $asignacion->estatu_asignacion }}</td>
                            <td style="text-align:center">{{ $asignacion->usuario }}</td>                                               
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    </center>
@endsection