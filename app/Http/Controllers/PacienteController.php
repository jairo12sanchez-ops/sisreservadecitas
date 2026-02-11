<?php

namespace App\Http\Controllers;

use App\Models\paciente;
use App\Models\Secretaria;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $pacientes = Paciente::all();
        return view('admin.pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
       // return response()->json($datos);
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'di' => 'required | unique:pacientes',
            'eps' => 'required',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'telefono' => 'required',
            'correo' => 'required | max:250|unique:pacientes',
            'direccion' => 'required',
            'grupo_sanguineo' => 'required',
            'alergias' => 'required',
            'contacto_emergencia' => 'required',
        ]);
        $paciente = new Paciente();
        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->di = $request->di;
        $paciente->eps= $request->eps;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->genero= $request->genero;
        $paciente->telefono = $request->telefono;
        $paciente->correo = $request->correo;
        $paciente->direccion = $request->direccion;
        $paciente->grupo_sanguineo = $request->grupo_sanguineo;
        $paciente->alergias = $request->alergias;
        $paciente->contacto_emergencia = $request->contacto_emergencia;
        $paciente->observaciones = $request->observaciones;
        $paciente->save();



        return redirect()->route('admin.pacientes.index')
            ->with('mensaje', '¡se registro correctamente!')
            ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $paciente =Paciente::findOrFail($id);
        return view('admin.pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paciente =Paciente::findOrFail($id);
        return view('admin.pacientes.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $paciente =Paciente::find($id);

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'di' => 'required | unique:pacientes,di,'.$paciente->$id,
            'eps' => 'required',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'telefono' => 'required',
            'correo' => 'required | max:250|unique:pacientes,correo,'.$paciente->$id,
            'direccion' => 'required',
            'grupo_sanguineo' => 'required',
            'alergias' => 'required',
            'contacto_emergencia' => 'required',
        ]);
        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->di = $request->di;
        $paciente->eps= $request->eps;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->genero= $request->genero;
        $paciente->telefono = $request->telefono;
        $paciente->correo = $request->correo;
        $paciente->direccion = $request->direccion;
        $paciente->grupo_sanguineo = $request->grupo_sanguineo;
        $paciente->alergias = $request->alergias;
        $paciente->contacto_emergencia = $request->contacto_emergencia;
        $paciente->observaciones = $request->observaciones;
        $paciente->save();

        return redirect()->route('admin.pacientes.index')
            ->with('mensaje', '¡se actualizo correctamente!')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete($id){
        $paciente = Paciente::findorFail($id);
        return view('admin.pacientes.delete', compact('paciente'));
    }

    public function destroy($id)
    {
        Paciente::destroy($id);
        return redirect()->route('admin.pacientes.index')
            ->with('mensaje', '¡se elimino correctamente!')
            ->with('icono', 'success');
    }

    public function buscar_por_di($di)
    {
        $paciente = Paciente::where('di', $di)->first();
        if ($paciente) {
            return response()->json([
                'status' => 'success',
                'paciente' => $paciente
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Paciente no encontrado'
            ]);
        }
    }
}
