@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Registro de un Nuevo Paciente</h1>
    </div>

    <hr>
    <div class="row">
        <div class="col-md-12"
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Ingrese los Datos</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/admin/pacientes/create')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">Nombres</label> <b>*</b>
                                <input type="text" value="{{old('nombres')}}" name="nombres" class="form-control" required>
                                @error('nombres')
                                <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">Apellidos</label> <b>*</b>
                                <input type="text" value="{{old('apellidos')}}" name="apellidos" class="form-control" required>
                                @error('apellidos')
                                <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">DI</label> <b>*</b>
                                <input type="text" value="{{old('di')}}" name="di" class="form-control" required>
                                @error('di')
                                <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">EPS</label> <b>*</b>
                                <input type="text" value="{{old('eps')}}" name="eps" class="form-control" required>
                                @error('eps')
                                <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">Fecha de Nacimiento</label> <b>*</b>
                                <input type="date" value="{{old('fecha_nacimiento')}}" name="fecha_nacimiento" class="form-control" required>
                                @error('fecha_nacimiento')
                                <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">Genero</label>
                                <select name="genero" id=""class="form-control">
                                    <option value="M">MASCULINO</option>
                                    <option value="F">FEMENINO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">Telefono</label> <b>*</b>
                                <input type="number" value="{{old('telefono')}}" name="telefono" class="form-control" required>
                                @error('telefono')
                                <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">Correo</label> <b>*</b>
                                <input type="email" value="{{old('correo')}}" name="correo" class="form-control" required>
                                @error('correo')
                                <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form group">
                                <label for="">Direccion</label> <b>*</b>
                                <input type="address" value="{{old('direccion')}}" name="direccion" class="form-control" required>
                                @error('direccion')
                                <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form group">
                            <label for="">Grupo Sanguineo</label>
                            <select name="grupo_sanguineo" id=""class="form-control">
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                    </div>
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">Alergias</label> <b>*</b>
                                <input type="text" value="{{old('alergias')}}" name="alergias" class="form-control" required>
                                @error('alergias')
                                <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form group">
                                <label for="">Contanto de Emergencia</label> <b>*</b>
                                <input type="number" value="{{old('contacto_emergencia')}}" name="contacto_emergencia" class="form-control" required>
                                @error('contacto_emergencia')
                                <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form group">
                                <label for="">Observaciones</label>
                                <input type="text" value="{{old('observaciones')}}" name="observaciones" class="form-control">
                                @error('observaciones')
                                <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form group">
                                <a href="{{url('admin/pacientes')}}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Registrar Paciente</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
@endsection
