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

<h2 style="text-align: center"><u>Historial Clinico</u></h2>

<br>

<div style="page-break-inside: avoid;">
    <table>
        <h3>Informacion Del Paciente</h3>
        <tr>
            <td><b>Identificacion: </b></td>
            <td>{{$paciente->di}}</td>
        </tr>
        <tr>
            <td><B>Paciente: </B></td>
            <td>{{$paciente->apellidos." ".$paciente->nombres}}</td>
        </tr>
        <tr>
            <td><b>Fecha De Nacimiento: </b></td>
            <td>{{$paciente->fecha_nacimiento}}</td>
        </tr>
        <tr>
            <td><B>EPS: </B></td>
            <td>{{$paciente->eps}}</td>
        </tr>
        <tr>
            <td><B>Correo: </B></td>
            <td>{{$paciente->correo}}</td>
        </tr>
    </table>
</div>
<hr>

<div>

    <h3>Diagnosticos Del Paciente</h3>
    <br>
    @foreach($historiales as $historiale)
        <hr>
        <div>
            <b>Fecha: </b> {{$historiale->fecha_visita}}
        </div>
        <br>
        <div>
            {!! $historiale->detalle !!}
        </div>
        <hr>
    @endforeach
</div>
</body>
</html>



