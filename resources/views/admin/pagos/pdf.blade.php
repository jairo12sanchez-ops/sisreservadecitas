<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,maximun-scale1.0. minimun-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie=edge">
    <title>Factura de Venta</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 8pt;
            margin: 0;
            padding: 10px;
        }
        .header-table {
            width: 100%;
            margin-bottom: 5px;
        }
        .header-table td {
            vertical-align: top;
        }
        .invoice-title {
            text-align: center;
            font-size: 12pt;
            font-weight: bold;
            margin: 5px 0;
            text-decoration: underline;
        }
        .info-section {
            width: 100%;
            margin-bottom: 5px;
        }
        .info-section td {
            vertical-align: top;
            padding: 1px 0;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        .items-table th, .items-table td {
            border: 1px solid #ccc;
            padding: 3px;
            text-align: left;
        }
        .items-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .text-right {
            text-align: right !important;
        }
        .totals-table {
            width: 40%;
            float: right;
            border-collapse: collapse;
        }
        .totals-table td {
            padding: 2px;
            text-align: right;
        }
        .bold {
            font-weight: bold;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>

@foreach(['ORIGINAL', 'COPIA'] as $tipo)
    <div class="invoice-container" style="height: 48%; position: relative; {{ $loop->first ? 'border-bottom: 1px dashed #ccc; margin-bottom: 10px; padding-bottom: 10px;' : '' }}">

        <table class="header-table">
            <tr>
                <td style="width: 70%">
                    {{$configuracion->nombre ?? 'Nombre no configurado'}} <br>
                    {{$configuracion->direccion ?? 'Dirección no configurada'}}<br>
                    {{$configuracion->telefono ?? 'Teléfono no configurado'}}<br>
                    {{$configuracion->correo ?? 'Correo no configurado'}}<br>
                </td>
                <td style="width: 30%; text-align: right;">
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
                            <img src="{{ $base64 }}" alt="logo" style="max-width: 70px; max-height: 50px;">
                        @else
                            <span>Sin Logo</span>
                        @endif
                    @endif
                    <br>
                    @if(isset($qrCodeBase64))
                        <div style="margin-top: 5px;">
                            <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code" style="max-width: 60px;">
                        </div>
                    @endif
                </td>
            </tr>
        </table>

        <div class="invoice-title">Factura de Venta</div>
        <div style="text-align: center; font-size: 8pt; color: #555; font-weight: bold; text-transform: uppercase; margin-bottom: 5px;">
            - {{ $tipo }} -
        </div>

        <table class="info-section">
            <tr>
                <td style="width: 15%;" class="bold">Fecha:</td>
                <td>{{$pago->fecha_pago}}</td>
            </tr>
            <tr>
                <td style="width: 15%;" class="bold">Eps:</td>
                <td>{{$pago->paciente->eps}}</td>
            </tr>
            <tr>
                <td class="bold">Paciente:</td>
                <td>{{$pago->paciente->nombres." ".$pago->paciente->apellidos}}</td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 30px;">No.</th>
                    <th>Producto/Servicio</th>
                    <th style="width: 50px;" class="text-right">Cant.</th>
                    <th style="width: 80px;" class="text-right">Precio</th>
                    <th style="width: 80px;" class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{$pago->descripcion}}</td>
                    <td class="text-right">1.0</td>
                    <td class="text-right">{{ number_format($pago->monto, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($pago->monto, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="clearfix">
            <table class="totals-table">
                <tr>
                    <td class="bold">Valor:</td>
                    <td>{{ number_format($pago->monto, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="bold">Descuento:</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td class="bold">Impuestos:</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td class="bold" style="font-size: 10pt;">Total:</td>
                    <td class="bold" style="font-size: 10pt;">{{ number_format($pago->monto, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="clearfix" style="margin-top: 10px;">
            <table class="items-table" style="border: none;">
                <tr>
                    <td style="width: 50%; vertical-align: top; height: 40px; border: none; padding: 0;">
                        <b>Elaborado por:</b><br>
                        <span style="font-size: 7pt;">{{ \Illuminate\Support\Facades\Auth::user()->name ?? 'Secretaria' }}</span><br><br>
                        _______________________ <br>
                        <span style="font-size: 7pt;">Firma</span>
                    </td>
                    <td style="width: 50%; vertical-align: top; height: 40px; border: none; padding: 0;">
                        <b>Recibí Conforme:</b><br><br><br>
                        _______________________ <br>
                        <span style="font-size: 7pt;">Firma y C.C.</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endforeach

</body>
</html>
