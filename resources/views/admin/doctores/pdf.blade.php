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
                <img src="{{storage_path('app/public/'.$configuracion->logo)}}" alt="logo" width="80px">
            @else
                <span>Sin Logo</span>
            @endif
        </td>
    </tr>
</table>

<br>

<h2 style="text-align: center"><u>Listado Del Personal Medico</u>

    <br>

    <table class="table table-bordered table-sm" width="100%" border="1" cellspacing="0" cellpadding="5">
        <thead>
        <tr style="background-color: #e7e7e7">
            <th>Nro</th>
            <th>Apellidos y Nombres</th>
            <th>Telefono</th>
            <th>Licencia Medica</th>
            <th>Especialidad</th>
        </tr>
        </thead>
        <tbody>
        <?php $contador = 1;?>
        @foreach($doctores as $doctore)
            <tr>
                <td style="text-align: center">{{$contador++}}</td>
                <td>{{$doctore->apellidos." ".$doctore->nombres}}</td>
                <td style="text-align: center">{{$doctore->telefono}}</td>
                <td>{{$doctore->licencia_medica}}</td>
                <td>{{$doctore->especialidad}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
