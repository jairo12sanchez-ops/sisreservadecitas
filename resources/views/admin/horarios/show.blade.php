@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Datos del Horario</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos Registrados</h3>
                </div>

                <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="doctor_id">Doctores</label>
                                  <p>{{$horario->doctor->nombres. " " .$horario->doctor->apellidos. "-" .$horario->doctor->especialidad}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Consultorio</label>
                                 <p>{{$horario->consultorio->nombre. " - " .$horario->consultorio->ubicacion}}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        {{-- Fila: Día / Hora inicio / Hora final --}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dia">Día</label>
                                    <p>{{$horario->dia}}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Hora Inicio</label>
                                    <p>{{$horario->hora_inicio}}</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hora_fin">Hora Final</label>
                                    <p>{{$horario->hora_fin}}</p>
                                </div>
                            </div>
                        </div>
                        <hr>

                        {{-- Botones --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('admin/horarios') }}" class="btn btn-secondary">Volver</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

