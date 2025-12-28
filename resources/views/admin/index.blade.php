@extends('layouts.admin')
@section('content')
    <div class="row">
        <h3><b>Bienvenido:</b> {{Auth::user()->email}}  / <b>Rol:</b>{{Auth::user()->roles->pluck('name')->first()}}</h3>
    </div>
    <hr>
    <div class="row">

        @can('admin.usuarios.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$total_usuarios}}</h3>
                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="fas bi bi-file-person"></i>
                    </div>
                    <a href="{{url('admin/usuarios')}}" class="small-box-footer">Mas Información <i class="fas bi bi-file-person"></i></a>
                </div>
            </div>
        @endcan

        @can('admin.secretarias.index')
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{$total_secretarias}}</h3>
                            <p>Secretarias</p>
                        </div>
                        <div class="icon">
                            <i class="fas bi bi-person-circle"></i>
                        </div>
                        <a href="{{url('admin/secretarias')}}" class="small-box-footer">Mas Información <i class="fas bi bi-file-person"></i></a>
                    </div>
                </div>
        @endcan

@can('admin.pacientes.index')
                <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$total_pacientes}}</h3>
                        <p>Pacientes</p>
                    </div>
                    <div class="icon">
                        <i class="fas bi bi-person-fill-check"></i>
                    </div>
                    <a href="{{url('admin/pacientes')}}" class="small-box-footer">Mas Información <i class="fas bi bi-file-person"></i></a>
                </div>
    </div>
@endcan
            @can('admin.consultorios.index')
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$total_consultorios}}</h3>
                            <p>Consultorios</p>
                        </div>
                        <div class="icon">
                            <i class="fas bi bi-house-heart-fill"></i>
                        </div>
                        <a href="{{url('admin/consultorios')}}" class="small-box-footer">Mas Información <i class="fas bi bi-file-person"></i></a>
                    </div>
                </div>
            @endcan

@can('admin.doctores.index')
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$total_doctores}}</h3>
                            <p>Doctores</p>
                        </div>
                        <div class="icon">
                            <i class="ion fas bi bi-person-square"></i>
                        </div>
                        <a href="{{url('admin/doctores')}}" class="small-box-footer">Mas Información <i class="fas bi bi-file-person"></i></a>
                    </div>
                </div>
@endcan

            @can('admin.horarios.index')
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{$total_horarios}}</h3>
                            <p>Horarios</p>
                        </div>
                        <div class="icon">
                            <i class="ion fas bi bi-calendar2-week"></i>
                        </div>
                        <a href="{{url('admin/horarios')}}" class="small-box-footer">Mas Información <i class="fas bi bi-file-person"></i></a>
                    </div>
                </div>
            @endcan
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="card-title">Calendario De Atencion de Doctores</h3>
                        </div>
                        <div class="col-md-4">
                            <div style="text-align: right">
                                <label for="consultorio_id">Consultorios</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="consultorio_id" id="consultorio_select" class="form-control">
                                <option value=""> Seleccione un Consultorio</option>
                                @foreach($consultorios as $consultorio)
                                    <option value="{{ $consultorio->id }}">{{ $consultorio->nombre . ' - ' . $consultorio->ubicacion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <script>
                        $('#consultorio_select').on('change',function () {
                            var consultorio_id = $('#consultorio_select').val();
                            //(consultorio_id);

                            if(consultorio_id){
                                $.ajax({
                                    url: "{{url('/consultorios/')}}"  + '/' +consultorio_id,
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


    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                           <h3 class="card-title">Calendario De Reservas de Citas Medicas</h3>
                        </div>
                        <div class="col-md-4">
                            <div style="text-align: right">
                                <label for="consultorio_id">Consultorios</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="consultorio_id" id="consultorio_select" class="form-control">
                                <option value=""> Seleccione un Consultorio</option>
                                @foreach($consultorios as $consultorio)
                                    <option value="{{ $consultorio->id }}">{{ $consultorio->nombre . ' - ' . $consultorio->ubicacion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Registrar cita
                        </button>

                        <!-- Modal -->
                        <form action="{{url('/admin/eventos/create')}}" method="post">
                            @csrf
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Reserva de Cita Odontologica</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Doctor</label>
                                                        <select name="doctor_id" id="" class="form-control">
                                                            @foreach ($doctores as $doctore)
                                                                <option value="{{ $doctore->id }}">
                                                                    {{ $doctore->nombres." ".$doctore->apellidos."-".$doctore->especialidad }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Fecha de Reserva</label>
                                                            <?php date_default_timezone_set('America/Bogota'); ?>
                                                        <input type="date" id="fecha_reserva"
                                                               value="<?php echo date('Y-m-d'); ?>" name="fecha_reserva" class="form-control">
                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function () {
                                                                const fechaReservaInput = document.getElementById('fecha_reserva');

                                                                // Escuchar el evento de cambio en el campo de fecha de reserva
                                                                fechaReservaInput.addEventListener('change', function () {
                                                                    let selectedDate = this.value; // Obtener la fecha seleccionada

                                                                    // Obtener la fecha actual en formato ISO (yyyy-mm-dd)
                                                                    let today = new Date().toISOString().slice(0, 10);

                                                                    // Verificar si la fecha seleccionada es anterior a la fecha actual
                                                                    if (selectedDate < today) {
                                                                        // Si es así, establecer la fecha seleccionada en null
                                                                        this.value = null;
                                                                        alert('No puede seleccionar una fecha pasada.');
                                                                    }
                                                                });
                                                            });
                                                        </script>

                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Hora de Reserva</label>
                                                        <input type="time" name="hora_reserva" id="hora_reserva" class="form-control">
                                                        @error('hora_reserva')
                                                        <small style="color:red">{{$message}}</small>
                                                        @enderror
                                                        @if( (($message = Session::get('hora_reserva'))) )
                                                            <script>
                                                              document.addEventListener('DOMContentLoaded', function (){
                                                                  $('#exampleModal').modal('show');
                                                              });
                                                            </script>
                                                            <small style="color:red">{{$message}}</small>
                                                        @endif
                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function () {
                                                                const horaReservaInput = document.getElementById('hora_reserva');

                                                                horaReservaInput.addEventListener('change', function () {
                                                                    let selectedTime = this.value; // Obtener el valor de la hora seleccionada

                                                                    // Asegurar que solo se capture la parte de la hora
                                                                    if (selectedTime) {
                                                                        selectedTime = selectedTime.split(':'); // Dividir la cadena en horas y minutos
                                                                        selectedTime = selectedTime[0];        // Conservar solo la hora, ignorar los minutos
                                                                        this.value = selectedTime + ':00';     // Reemplazar la hora modificada en el campo de entrada
                                                                    }

                                                                    // Verificar si la hora seleccionada está fuera del rango permitido
                                                                    if (selectedTime < 8 || selectedTime > 20) {
                                                                        this.value = null;
                                                                        alert('Por favor, seleccione una hora entre las 08:00 y las 20:00.');
                                                                    }
                                                                });
                                                            });
                                                        </script>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Registrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id='calendar'></div>
                </div>
            </div>

        </div>
    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale:'es',
                events:  [
                    @foreach($eventos as $evento)
                    {
                        title:'{{$evento->title}}',
                        start:'{{$evento->start}}',
                        end: '{{$evento->end}}',
                        color:'#dc5362'
                    },
                    @endforeach
                ]
            });
            calendar.render();
        });
    </script>
@endsection
