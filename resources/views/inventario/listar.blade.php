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
        });
    </script>
    <div>
        <style>
            th{
                text-align:center;
                align-items:center;
            }
        </style>
        <br><br>
        <h2>Listado - Inventarios</h2><span style=""></span>
        <br><br>
        <div style="align-item:center; max-width:600px; display:table;">
        <table id="datostbl" class="table table-bordered table-striped">
            <thead class="bg-primary">
                <th style="color:#fff">Tipo de equipo</th>
                <th style="color:#fff">Marca y Modelo</th>
                <th style="color:#fff">Procesador</th>
                <th style="color:#fff">Memoria Ram</th>
                <th style="color:#fff">Disco Duro</th>
                <th style="color:#fff">Sistema Operativo</th>
                <th style="color:#fff">Fecha Inventario</th>
                <th style="color:#fff">N serial.</th>
                <th style="color:#fff">Bien Nacional</th>
                <th style="color:#fff">MAC</th>
                <th style="color:#fff">IP</th>
            </thead>
            <tboddy>
                @foreach($inventarios as $inventario)
                    <tr>
                        <td style="text-align:center">{{ $inventario->tipo_equipo }}</td>
                        <td style="text-align:center">{{ $inventario->modelo }}</td>
                        <td style="text-align:center">{{ $inventario->procesador }}</td>
                        <td style="text-align:center">{{ $inventario->memoria }}</td>
                        <td style="text-align:center">{{ $inventario->unidad_disco }}</td>
                        <td style="text-align:center">{{ $inventario->sistema_operativo }}</td>
                        <td style="text-align:center">{{ $inventario->fecha_invequipo }}</td>
                        <td style="text-align:center">{{ $inventario->nserial }}</td>
                        <td style="text-align:center">{{ $inventario->bien_nacional }}</td>
                        <td style="text-align:center">{{ $inventario->mac_invequipo }}</td>
                        <td style="text-align:center">{{ $inventario->ip_invequipo }}</td>                        
                    </tr>
                @endforeach
            </tboddy>
        </table>
        </div>
    </div>
    </center>
@endsection