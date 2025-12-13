@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Modificar Secretaria {{$secretaria->nombres}} {{$secretaria->apellidos}}</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los Datos</h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('/admin/secretarias', $secretaria->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Nombres <b>*</b></label>
                                    <input type="text" value="{{ $secretaria->nombres }}" name="nombres" class="form-control" required>
                                    @error('nombres')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Apellidos <b>*</b></label>
                                    <input type="text" value="{{ $secretaria->apellidos }}" name="apellidos" class="form-control" required>
                                    @error('apellidos')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">DI <b>*</b></label>
                                    <input type="text" value="{{ $secretaria->di }}" name="di" class="form-control" required>
                                    @error('di')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Teléfono <b>*</b></label>
                                    <input type="text" value="{{ $secretaria->telefono }}" name="telefono" class="form-control" required>
                                    @error('telefono')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fecha de Nacimiento <b>*</b></label>
                                    <input type="date" value="{{ $secretaria->fecha_nacimiento }}" name="fecha_nacimiento" class="form-control" required>
                                    @error('fecha_nacimiento')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="">Dirección <b>*</b></label>
                                    <input type="text" value="{{ $secretaria->direccion }}" name="direccion" class="form-control" required>
                                    @error('direccion')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Email <b>*</b></label>
                                    <input type="email" value="{{ $secretaria->user->email }}" name="email" class="form-control" required>
                                    @error('email')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" value="{{ old('password') }}" name="password" class="form-control">
                                    @error('password')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Password Verificación</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                        @error('password_confirmation')
                                        <small style="color:red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('admin/secretarias') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar Registro</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
