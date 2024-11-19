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
                <table class="table table-bordered table-striped" id="usuarios">
                    <thead class="table-dark">
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Perfil</th>
                        <th>Usuario</th>                                               
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