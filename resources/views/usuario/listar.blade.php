@extends('layout.header')

@section('contenido') 
    <center>
        @if (session('success'))
            <script>
                swal("","{{session('success')}}","success");
            </script>
        @endif

        <script>
            $('#usuarios').DataTable({    
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
        </script>
        <div>
            <style>
                th{
                    text-align:center;
                    align-items:center;
                }
            </style>

            
            <h2>Listado - Usuarios</h2><span style=""></span>
            <br/>
            <div style="align-item:center; max-width:600px; display:table; min-width:250px">
                <table class="bg table-bordered table-striped" id="usuarios">
                    <thead class="table-primary">
                        <th style="color:#fff">Cedula</th>
                        <th style="color:#fff">Nombre</th>
                        <th style="color:#fff">Apellido</th>
                        <th style="color:#fff">Correo</th>
                        <th style="color:#fff">Perfil</th>
                        <th style="color:#fff">Usuario</th>                                               
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td style="text-align:center">{{ $usuario->cedula }}</td>
                                <td style="text-align:center">{{ $usuario->nombre }}</td>
                                <td style="text-align:center">{{ $usuario->apellido }}</td>
                                <td style="text-align:center">{{ $usuario->correo }}</td>
                                <td style="text-align:center">{{ $usuario->perfil }}</td>                               
                                <td style="text-align:center">{{ $usuario->usuario }}</td>                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </center>
@endsection