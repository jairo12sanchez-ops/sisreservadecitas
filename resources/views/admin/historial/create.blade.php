@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Registro De Una Nueva Historia Clinica</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los Datos</h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('/admin/historial/create') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
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
                                            <label for="">Fecha De La Cita Medica</label>
                                            <input type="date" value="<?php echo date('Y-m-d');?>"  name="fecha_visita" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                @if(!Auth::user()->doctor)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Doctor</label>
                                            <select name="doctor_id" id="" class="form-control">
                                                @foreach($doctores as $doctor)
                                                    <option value="{{$doctor->id}}">{{$doctor->apellidos." ".$doctor->nombres}} - {{$doctor->especialidad}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <br>
                                <div class="rom">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="">Descripcion De La Cita</label>
                                          <textarea name="detalle" class="form-control" id="editor" cols="30" rows="100" style="width: 100%;height: 500px"></textarea>
                                          <script type="importmap">
                                              {
                                                "imports": {
                                                  "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.js"
                                                }
                                              }
                                          </script>

                                          <script type="module">
                                              import {
                                                  ClassicEditor,
                                                  Essentials,
                                                  Bold,
                                                  Italic,
                                                  Font,
                                                  Paragraph
                                              } from 'ckeditor5';

                                              ClassicEditor
                                                  .create( document.querySelector( '#editor' ), {
                                                      plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
                                                      toolbar: {
                                                          items: [
                                                              'undo', 'redo', '|', 'bold', 'italic', '|',
                                                              'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                                                          ]
                                                      }
                                                  } )
                                                  .catch( error => {
                                                      console.error( error );
                                                  } );
                                          </script>

                                      </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('admin/historial') }}" class="btn btn-secondary">Cancelar</a>
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



