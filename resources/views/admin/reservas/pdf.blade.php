<?php
?>

    <!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,maximun-scale1.0. minimun-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
<table border="0" style="font-size: 8pt">
    <tr>
        <td style="text-align: center">
            {{$configuracion->nombre ?? 'Nombre no configurado'}} <br>
            {{$configuracion->direccion ?? 'Dirección no configurada'}}<br>
            {{$configuracion->telefono ?? 'Teléfono no configurado'}}<br>
            {{$configuracion->correo ?? 'Correo no configurado'}}<br>
        </td>
        <td width="330px"></td>
        <td>
            @if($configuracion && $configuracion->logo)
                @php
                    $path = storage_path('app/public/'.$configuracion->logo);
                    if (file_exists($path)) {
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    } else {
                        $base64 = null;
                    }
                @endphp
                @if($base64)
                    <img src="{{ $base64 }}" alt="logo" width="80px">
                @else
                    <span>Sin Logo (Archivo no encontrado)</span>
                @endif
            @else
                <span>Sin Logo</span>
            @endif
        </td>
    </tr>
</table>

<br>

<h2 style="text-align: center"><u>Listado De Reservas Odontologicas</u>

    <br>

    <table class="table table-bordered table-sm" width="100%" border="1" cellspacing="0" cellpadding="5">
        <thead>
        <tr style="background-color: #e7e7e7">
            <th>Nro</th>
            <th>Doctor</th>
            <th>Especialidad</th>
            <th>Fecha De Reserva</th>
            <th>Hora De Reserva</th>
        </tr>
        </thead>
        <tbody>
        <?php $contador = 1;?>
        @foreach($eventos   as $evento)
            <tr>
                <td style="text-align: center">{{$contador++}}</td>
                <td>{{$evento->doctor->nombres." ".$evento->doctor->apellidos}}</td>
                <td style="text-align: center">{{$evento->doctor->especialidad}}</td>
                <td style="text-align: center">{{\Carbon\Carbon::parse($evento->start)->format('Y-m-d')}}</td>
                <td style="text-align: center">{{\Carbon\Carbon::parse($evento->start)->format('H:i')}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
