@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Registro de Nuevo Horario</h1>
    </div>
    <hr>

    {{-- Fila principal: ambas columnas, misma altura --}}
    <div class="row align-items-stretch">
        {{-- Columna izquierda: Formulario (más pequeña) --}}
        <div class="col-md-3 d-flex">
            <div class="card card-outline card-primary h-100 w-100">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los Datos</h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('/admin/horarios/create') }}" method="POST">
                        @csrf
                        {{-- Fila: Consultorio --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="consultorio_id">Consultorio <b>*</b></label>
                                    <select name="consultorio_id" id="consultorio_id" class="form-control">
                                        <option value="">Seleccionar Consultorio</option>
                                        @foreach($consultorios as $consultorio)
                                            <option value="{{ $consultorio->id }}">
                                                {{ $consultorio->nombre . ' - ' . $consultorio->ubicacion }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Fila: Doctor --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="doctor_id">Doctores <b>*</b></label>
                                    <select name="doctor_id" id="doctor_id" class="form-control">
                                        @foreach($doctores as $doctor)
                                            <option value="{{ $doctor->id }}">
                                                {{ $doctor->nombres . ' ' . $doctor->apellidos . ' - ' . $doctor->especialidad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Fila: Día / Hora inicio / Hora final --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="dia">Día <b>*</b></label>
                                    <select name="dia" id="dia" class="form-control">
                                        <option value="LUNES">LUNES</option>
                                        <option value="MARTES">MARTES</option>
                                        <option value="MIERCOLES">MIERCOLES</option>
                                        <option value="JUEVES">JUEVES</option>
                                        <option value="VIERNES">VIERNES</option>
                                        <option value="SABADO">SABADO</option>
                                        <option value="DOMINGO">DOMINGO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="hora_inicio">Hora Inicio <b>*</b></label>
                                    <input
                                        type="time"
                                        id="hora_inicio"
                                        name="hora_inicio"
                                        value="{{ old('hora_inicio') }}"
                                        class="form-control"
                                        required>
                                    @error('hora_inicio')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="hora_fin">Hora Final <b>*</b></label>
                                    <input
                                        type="time"
                                        id="hora_fin"
                                        name="hora_fin"
                                        value="{{ old('hora_fin') }}"
                                        class="form-control"
                                        required>
                                    @error('hora_fin')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        {{-- Botones --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('admin/horarios') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Registrar Nuevo</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Columna derecha: Calendario (más amplia) --}}
        <div class="col-md-9 d-flex">
            <div id="consultorio_info" class="w-100">
                {{-- Aquí se cargará el calendario vía AJAX --}}
            </div>
        </div>
    </div>

    {{-- ✅ SCRIPT CORREGIDO - Al final del contenido --}}
    <script>
        $(document).ready(function() {
            $('#consultorio_id').on('change', function() {
                var consultorio_id = $(this).val();

                if(consultorio_id) {
                    $.ajax({
                            url: "{{url('/admin/horarios/consultorios/')}}"  + '/' +consultorio_id,
                        type: 'GET',
                        beforeSend: function() {
                            $('#consultorio_info').html('<div class="text-center p-5"><i class="fas fa-spinner fa-spin fa-2x"></i><br>Cargando calendario...</div>');
                        },
                        success: function(data) {
                            $('#consultorio_info').html(data);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error AJAX:', xhr.responseText);
                            $('#consultorio_info').html('<div class="alert alert-danger">Error al cargar el calendario del consultorio. Verifique la consola del navegador.</div>');
                        }
                    });
                } else {
                    $('#consultorio_info').html('');
                }
            });
        });
    </script>
@endsection
