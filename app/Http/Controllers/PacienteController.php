<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
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

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => '¡se registro correctamente!',
                'paciente' => $paciente
            ], 201);
        }

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
        $paciente = Paciente::find($id);

        if (!$paciente) {
            if (request()->wantsJson() || request()->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Paciente no encontrado'
                ], 404);
            }
            return redirect()->route('admin.pacientes.index')
                ->with('mensaje', 'Paciente no encontrado')
                ->with('icono', 'error');
        }

        $request->validate([
            'nombres' => 'sometimes|required',
            'apellidos' => 'sometimes|required',
            'di' => 'sometimes|required|unique:pacientes,di,'.$paciente->id,
            'eps' => 'sometimes|required',
            'fecha_nacimiento' => 'sometimes|required',
            'genero' => 'sometimes|required',
            'telefono' => 'sometimes|required',
            'correo' => 'sometimes|required|max:250|unique:pacientes,correo,'.$paciente->id,
            'direccion' => 'sometimes|required',
            'grupo_sanguineo' => 'sometimes|required',
            'alergias' => 'sometimes|required',
            'contacto_emergencia' => 'sometimes|required',
        ]);

        $paciente->nombres = $request->input('nombres', $paciente->nombres);
        $paciente->apellidos = $request->input('apellidos', $paciente->apellidos);
        $paciente->di = $request->input('di', $paciente->di);
        $paciente->eps = $request->input('eps', $paciente->eps);
        $paciente->fecha_nacimiento = $request->input('fecha_nacimiento', $paciente->fecha_nacimiento);
        $paciente->genero = $request->input('genero', $paciente->genero);
        $paciente->telefono = $request->input('telefono', $paciente->telefono);
        $paciente->correo = $request->input('correo', $paciente->correo);
        $paciente->direccion = $request->input('direccion', $paciente->direccion);
        $paciente->grupo_sanguineo = $request->input('grupo_sanguineo', $paciente->grupo_sanguineo);
        $paciente->alergias = $request->input('alergias', $paciente->alergias);
        $paciente->contacto_emergencia = $request->input('contacto_emergencia', $paciente->contacto_emergencia);
        $paciente->observaciones = $request->input('observaciones', $paciente->observaciones);
        
        $paciente->save();

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => '¡se actualizo correctamente!',
                'paciente' => $paciente
            ]);
        }

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
        $paciente = Paciente::find($id);
        if (!$paciente) {
            if (request()->wantsJson() || request()->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Paciente no encontrado'
                ], 404);
            }
            return redirect()->route('admin.pacientes.index')
                ->with('mensaje', 'Paciente no encontrado')
                ->with('icono', 'error');
        }

        $paciente->delete();

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => '¡se elimino correctamente!'
            ]);
        }

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
