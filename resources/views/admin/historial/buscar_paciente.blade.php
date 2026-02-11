@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Busqueda de Paciente:</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Buscar Al Paciente</h3>
                </div>

                <div class="card-body">
                    <form action="{{route('admin.historial.buscar_paciente')}}" method="get">
                      <div class="row">
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="">Identificacion</label>
                                  <input type="text" name="di" class="form-control">
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                                  <div style="height: 32px"></div>
                                  <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i>Buscar</button>
                              </div>
                          </div>
                      </div>
                    </form>
                    <hr>
                    @if($paciente)
                        <h4>Informacion Del Paciente</h4>
                        <div class="row">
                            <table>
                               <tr>
                                   <td><b>Identificacion: </b></td>
                                   <td>{{$paciente->di}}</td>
                               </tr>
                            <tr>
                                <td><B>Paciente: </B></td>
                                <td>{{$paciente->apellidos." ".$paciente->nombres}}</td>
                            </tr>
                            <tr>
                                <td><b>Fecha De Nacimiento: </b></td>
                                <td>{{$paciente->fecha_nacimiento}}</td>
                            </tr>
                            <tr>
                                <td><B>EPS: </B></td>
                                <td>{{$paciente->eps}}</td>
                            </tr>
                            <tr>
                                <td><B>Correo: </B></td>
                                <td>{{$paciente->correo}}</td>
                            </tr>
                            </table>
                        </div>
                        <br>
                        <a href="{{url('/admin/historial/paciente', $paciente->id)}}" class="btn btn-warning">Imprimir Historial Odontologico</a>
                    @else
                        <p>Paciente No Enconrado</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

