
<br>
<center>
    <style>
        boddy{
            font-family: Arial, sans-serif;
            background-color:#f2f2f2;
            padding:20px
        }

        h1{
            text-align:center;
            color: #333;
        }

        table{
            font-size:5px
            width:100%
            border-collapse:collapse;
            margin-top:20px;
            background-color:$fff;
            box-shadow:0 0 10px rbga(0,0,0,0,1); 
        }

        th, td{
            
            border: 2px solid silver;
            padding:12px
            paddin
        }

        th{
            background-color:#f2f2f2;
        }

        tr:nth.child(even) {
            background-color:#f9f9f9;
        }

        tr:hover{
            background-color:#e9e9e9;
        }

        
    </style>
    <img src="{{ asset(img/cintilloizq2023.png) }}" alt="">
    <div style="text-align:right; color: #000; font-size:20px">Caracas, <?php echo date('d-m-Y'); ?></div>
    <h1>Reporte por Dependencia</h1>
    
    
    <table>
        <thead>
                <th style="font: size 14px;|px">Funcionario</th>
                <th style="font-size:14px">Telefono</th>
                <th style="font-size:14px">Usuario Dominio</th>
                <th style="font-size:14px">Correos </th>
                <th style="font-size:14px">Piso, Departamento, Dependencia</th>
                <th style="font-size:14px">Cargo</th>
                <th style="font-size:14px">Tipo equipo, Modelo</td>
                <th style="font-size:14px">Procesador, Memoria Ram ,Disco Duro</td>
                <th style="font-size:14px">Sistema Operativo</td>
                <th style="font-size:14px">Fecha Asignacion</th>
                <th style="font-size:14px">Estatus</th>
                <th style="font-size:14px">Usuario</th>
        </t4ead>
        <tbody>            
            @foreach($dependencias as $dependencia)               
                <tr>
                    <td style="font-size:12px; text-align:center">{{ $dependencia->cedulafun }}<br>{{ $dependencia->nombrefun }} {{ $dependencia->apellidofun }}</td>
                    <td style="font-size:12px; text-align:center">{{ $dependencia->telefono }}</td>
                    <td style="font-size:12px; text-align:center">{{ $dependencia->usuario_dominio }}</td>
                    <td style="font-size:12px; text-align:center">{{ $dependencia->correo_personal }} <br>{{ $dependencia->correo_inst }}</td>
                    <td style="font-size:12px; text-align:center">{{ $dependencia->piso }} <br>{{ $dependencia->dependencia }} <br>{{ $dependencia->departamento }}</td>
                    <td style="font-size:12px; text-align:center">{{ $dependencia->cargo }}</td>
                    <td style="font-size:12px; text-align:center">{{ $dependencia->tipo_equipo }} <br>{{ $dependencia->modelo }}</td>
                    <td style="font-size:12px; text-align:center">{{ $dependencia->procesador }} <br>{{ $dependencia->memoria }} <br>{{ $dependencia->unidad_disco }} <br></td>
                    <td style="font-size:12px; text-align:center">{{ $dependencia->sistema_operativo }}</td>
                    <td style="font-size:12px; text-align:center">{{ $dependencia->fecha_asignacion }}</td>
                    <td style="font-size:12px; text-align:center">{{ $dependencia->estatu_asignacion }}</td>
                    <td style="font-size:12px; text-align:center">{{ $dependencia->usuario }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</center>
