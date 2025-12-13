@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Registro de Nuevo Doctor</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los Datos</h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('/admin/doctores/create') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Nombres <b>*</b></label>
                                    <input type="text" value="{{ old('nombres') }}" name="nombres" class="form-control" required>
                                    @error('nombres')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Apellidos <b>*</b></label>
                                    <input type="text" value="{{ old('apellidos') }}" name="apellidos" class="form-control" required>
                                    @error('apellidos')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Telefono <b>*</b></label>
                                    <input type="number" value="{{ old('telefono') }}" name="telefono" class="form-control" required>
                                    @error('telefono')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Licencia Medica <b>*</b></label>
                                    <input type="text" value="{{ old('licencia_medica') }}" name="licencia_medica" class="form-control" required>
                                    @error('licencia_medica')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Especialidad <b>*</b></label>
                                    <input type="text" value="{{ old('especialidad') }}" name="especialidad" class="form-control" required>
                                    @error('especialidad')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Email<b>*</b></label>
                                    <input type="email" value="{{ old('email') }}" name="email" class="form-control" required>
                                    @error('email')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Password <b>*</b></label>
                                    <input type="password" value="{{ old('password') }}" name="password" class="form-control" required>
                                    @error('password')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Password Verificación <b>*</b></label>
                                        <input type="password" name="password_confirmation" class="form-control" required>
                                        @error('password_confirmation')
                                        <small style="color:red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('admin/doctores') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Registrar Nuevo</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

