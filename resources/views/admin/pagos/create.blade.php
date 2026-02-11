@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Registro De Pagos</h1>
    </div>
    <hr>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const montoInput = document.getElementById('monto');
            const form = document.getElementById('form_pago');

            montoInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, ""); // Remove anything that is not a digit
                if (value === "") {
                    e.target.value = "";
                    return;
                }
                // Format with dots for thousands
                e.target.value = new Intl.NumberFormat('de-DE').format(value);
            });

            form.addEventListener('submit', function(e) {
                // Before submitting, remove the dots from the amount field
                const rawValue = montoInput.value.replace(/\./g, "");
                montoInput.value = rawValue;
            });
        });
    </script>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los Datos</h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('/admin/pagos/create') }}" method="POST" id="form_pago">
                        @csrf
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Paciente</label>
                                        <select name="paciente_id" id="" class="form-control">
                                            @foreach($pacientes as $paciente)
                                                <option value="{{$paciente->id}}">{{$paciente->apellidos." ".$paciente->nombres}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Doctores</label>
                                    <select name="doctor_id" id="" class="form-control">
                                        @foreach($doctores as $doctore)
                                            <option value="{{$doctore->id}}">{{$doctore->apellidos." ".$doctore->nombres."-".$doctore->especialidad}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fecha De Pago</label>
                                    <input type="date" name="fecha_pago"  value="<?php echo date('Y-m-d')?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Monto</label>
                                    <input type="text" name="monto" id="monto" class="form-control" placeholder="0" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Descripcion</label>
                                    <input type="text" name="descripcion"    class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('admin/pagos') }}" class="btn btn-secondary">Cancelar</a>
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




