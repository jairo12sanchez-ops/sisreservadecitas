@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Doctor: {{$doctor->nombres." ".$doctor->apellidos}}</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Estas Seguro de Eliminar este Registro</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/doctores', $doctor->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nombres</label>
                                <p>{{$doctor->nombres}}</p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Apellidos</label>
                                <p>{{$doctor->apellidos}}</p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Telefono</label>
                                <p>{{$doctor->telefono}}</p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Licencia Medica</label>
                                <p>{{$doctor->licencia_medica}}</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Especialidad</label>
                                <p>{{$doctor->especialidad}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Email<b>*</b></label>
                                <p>{{$doctor->user->email}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{ url('admin/doctores') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-danger">Eliminar Registro</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection



