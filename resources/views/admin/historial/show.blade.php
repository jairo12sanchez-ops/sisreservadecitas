@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Paciente: {{$historial->paciente->apellidos." ".$historial->paciente->nombres}}</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los Datos</h3>
                </div>

                <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Paciente</label>
                                            <p>{{$historial->paciente->apellidos." ".$historial->paciente->nombres}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Fecha De La Cita Medica</label>
                                           <p>{{$historial->fecha_visita}}</p>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="rom">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Descripcion De La Cita</label>
                                            <td>{!! $historial->detalle !!}</td>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('admin/historial') }}" class="btn btn-secondary">Volver</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection




