@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Listado de Reservas</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Reservas Registradas</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                        <thead style="background-color: #c0c0c0">
                        <tr>
                            <th style="text-align: center"><b>Nro</b></th>
                            <th style="text-align: center"><b>Doctor</b></th>
                            <th style="text-align: center"><b>Especialidad</b></th>
                            <th style="text-align: center"><b>Fecha de Reserva</b></th>
                            <th style="text-align: center"><b>Hora de Reserva</b></th>
                            <th style="text-align: center"><b>Fecha y Hora de Registro</b></th>
                            <th style="text-align: center"><b>Acciones</b></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $contador=1;?>
                        @foreach($eventos as $evento)
                            <tr>
                                <td style="text-align: center">{{ $contador++}}</td>
                                <td>{{ $evento->doctor->nombres." ".$evento->doctor->apellidos}}</td>
                                <td style="text-align: center">{{ $evento->doctor->especialidad}}</td>
                                <td style="text-align: center">{{ \Carbon\Carbon::parse($evento->start)->format('Y-m-d')}}</td>
                                <td style="text-align: center">{{ \Carbon\Carbon::parse($evento->start)->format('H:i')}}</td>
                                <td style="text-align: center">{{ $evento->created_at}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form action="{{ url('/admin/eventos/destroy') }}"
                                              id="formulario{{$evento->id}}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $evento->id }}">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="preguntar{{$evento->id}}(event)">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                        {{-- SCRIPT UNA SOLA VEZ AL FINAL --}}
                        <script>
                            @foreach($eventos as $evento)
                            function preguntar{{$evento->id}}(event) {
                                event.preventDefault();
                                Swal.fire({
                                    title: "¿Está seguro de Eliminar este registro de Reserva?",
                                    text: "Si elimina este registro, otro usuario podrá reservar en este mismo horario",
                                    icon: "question",
                                    showDenyButton: true,
                                    confirmButtonText: "Eliminar",
                                    denyButtonText: "Cancelar"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $('#formulario{{$evento->id}}').submit();
                                    }
                                });
                            }
                            @endforeach
                        </script>

                    </table>
                    <script>
                        $(function () {
                            $("#example1").DataTable({
                                "pageLength": 5,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Reservas",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Reservas",
                                    "infoFiltered": "(Filtrado de _MAX_ total Reservas)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Reservas",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscador:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Ultimo",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                "responsive": true, "lengthChange": true, "autoWidth": false,
                                buttons: [{
                                    extend: 'collection',
                                    text: 'Reportes',
                                    orientation: 'landscape',
                                    buttons: [{
                                        text: 'Copiar',
                                        extend: 'copy',
                                    }, {
                                        extend: 'pdf'
                                    },{
                                        extend: 'csv'
                                    },{
                                        extend: 'excel'
                                    },{
                                        text: 'Imprimir',
                                        extend: 'print'
                                    }
                                    ]
                                },
                                    {
                                        extend: 'colvis',
                                        text: 'Visor de columnas',
                                        collectionLayout: 'fixed three-column'
                                    }
                                ],
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        });
                    </script>
                </div>
            </div>
        </div>

    </div>
@endsection


