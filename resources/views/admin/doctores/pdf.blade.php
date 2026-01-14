<?php
?>
    <!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0,minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
<table border="0" style="font-size: 8pt">
    <tr>
        <td style="text-align: center">
            {{$configuracion->nombre}} <br>
            {{$configuracion->direccion}} <br>
            {{$configuracion->telefono}} <br>
            {{$configuracion->correo}} <br>
        </td>
        <td width="330px"></td>
        <td>
            <img src="{{ public_path('storage/logos/3doqZa4OjEggvu26DKSoWIL7C8VW6kOa4GQ4hk3h.jpg') }}" width="80px">
        </td>
    </tr>
</table>

<br>

<h3 style="text-align: center"><u>Listado Del Personal Medico</u></h3>

<br>

<table class="table table-bordered table-sm" width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
    <tr style="background-color:#7e7e7e;">
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

