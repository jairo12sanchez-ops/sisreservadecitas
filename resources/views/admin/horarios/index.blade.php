@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Listado de Horarios</h1>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Horarios Registrados</h3>
                    <div class="card-tools">
                        <a href="{{ url('admin/horarios/create') }}" class="btn btn-primary">
                            Registrar Nuevo
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                        <thead style="background-color: #c0c0c0">
                        <tr>
                            <th class="text-center"><b>Nro</b></th>
                            <th class="text-center"><b>Doctor</b></th>
                            <th class="text-center"><b>Especialidad</b></th>
                            <th class="text-center"><b>Consultorio</b></th>
                            <th class="text-center"><b>Día de Atención</b></th>
                            <th class="text-center"><b>Hora Inicio</b></th>
                            <th class="text-center"><b>Hora Fin</b></th>
                            <th class="text-center"><b>Acciones</b></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $contador = 1; ?>
                        @foreach($horarios as $horario)
                            <tr>
                                <td class="text-center">{{ $contador++ }}</td>
                                <td>{{ $horario->doctor->nombres . ' ' . $horario->doctor->apellidos }}</td>
                                <td>{{ $horario->doctor->especialidad }}</td>
                                <td>
                                    {{ $horario->consultorio->nombre }}
                                    - Ubicación: {{ $horario->consultorio->ubicacion }}
                                </td>
                                <td class="text-center">{{ $horario->dia }}</td>
                                <td class="text-center">{{ $horario->hora_inicio }}</td>
                                <td class="text-center">{{ $horario->hora_fin }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        <a href="{{ url('admin/horarios/' . $horario->id) }}"
                                           type="button"
                                           class="btn btn-info btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ url('admin/horarios/' . $horario->id . '/edit') }}"
                                           type="button"
                                           class="btn btn-success btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ url('admin/horarios/' . $horario->id . '/confirmDelete') }}"
                                           type="button"
                                           class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <script>
                        $(function () {
                            const table = $("#example1").DataTable({
                                pageLength: 5,
                                language: {
                                    emptyTable: "No hay información",
                                    info: "Mostrando _START_ a _END_ de _TOTAL_ Horarios",
                                    infoEmpty: "Mostrando 0 a 0 de 0 Horarios",
                                    infoFiltered: "(Filtrado de _MAX_ total Horarios)",
                                    lengthMenu: "Mostrar _MENU_ Horarios",
                                    loadingRecords: "Cargando...",
                                    processing: "Procesando...",
                                    search: "Buscador:",
                                    zeroRecords: "Sin resultados encontrados",
                                    paginate: {
                                        first: "Primero",
                                        last: "Último",
                                        next: "Siguiente",
                                        previous: "Anterior"
                                    }
                                },
                                responsive: true,
                                lengthChange: true,
                                autoWidth: false,
                                buttons: [
                                    {
                                        extend: 'collection',
                                        text: 'Reportes',
                                        orientation: 'landscape',
                                        buttons: [
                                            { extend: 'copy', text: 'Copiar' },
                                            { extend: 'pdf' },
                                            { extend: 'csv' },
                                            { extend: 'excel' },
                                            { extend: 'print', text: 'Imprimir' }
                                        ]
                                    },
                                    {
                                        extend: 'colvis',
                                        text: 'Visor de columnas',
                                        collectionLayout: 'fixed three-column'
                                    }
                                ],
                            });

                            table.buttons().container()
                                .appendTo('#example1_wrapper .col-md-6:eq(0)');
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Calendario De Atención De Doctores</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group">
                            <label for="consultorio_id">Consultorios</label>
                            <select name="consultorio_id" id="consultorio_select" class="form-control">
                                @foreach($consultorios as $consultorio)
                                    <option value="{{ $consultorio->id }}">
                                        {{ $consultorio->nombre . ' - ' . $consultorio->ubicacion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <script>
                        $('#consultorio_select').on('change',function () {
                            var consultorio_id = $('#consultorio_select').val();
                            //(consultorio_id);
                            var url ="{{route('admin.horarios.cargar_datos_consultorios',':id')}}";
                            url = url.replace(':id',consultorio_id);

                            if(consultorio_id){
                                $.ajax({
                                    url: url,
                                    type:'GET',
                                    success: function (data){
                                        $('#consultorio_info').html(data);
                                    },
                                    error: function (){
                                        alert('Error al obtener los datos del consultorio');
                                    }
                                });
                            }else{
                                $('#consultorio_info').html('');
                            }
                        });
                    </script>
                    <hr>
                    <div id="consultorio_info">

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
