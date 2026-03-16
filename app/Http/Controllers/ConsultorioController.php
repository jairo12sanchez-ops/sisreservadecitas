<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use Illuminate\Http\Request;

class ConsultorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultorios = Consultorio::all();
        return view('admin.consultorios.index', compact('consultorios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.consultorios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
         //return response()->json($datos);
        $request->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
            'capacidad' => 'required',
            'especialidad' => 'required',
            'estado' => 'required',
        ]);

        $consultorio = Consultorio::create($request->all());

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Consultorio creado',
                'consultorio' => $consultorio
            ], 201);
        }

        return redirect()->route('admin.consultorios.index')
        ->with('mensaje', 'Consultorio creado')
        ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $consultorio = Consultorio::findorFail($id);
        return view('admin.consultorios.show', compact('consultorio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $consultorio = Consultorio::findorFail($id);
        return view('admin.consultorios.edit', compact('consultorio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
            'capacidad' => 'required',
            'especialidad' => 'required',
            'estado' => 'required',
        ]);
        $consultorio= Consultorio:: find($id);
        $consultorio->update($request->all());

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Consultorio Actualizado',
                'consultorio' => $consultorio
            ]);
        }

        return redirect()->route('admin.consultorios.index')
            ->with('mensaje', 'Consultorio Actualizado')
            ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete($id){
        $consultorio = Consultorio::findorFail($id);
        return view('admin.consultorios.delete', compact('consultorio'));
    }
    public function destroy($id)
    {
        $consultorio = Consultorio::find($id);
        if (!$consultorio) {
            if (request()->wantsJson() || request()->is('api/*')) {
                return response()->json(['status' => 'error', 'message' => 'Consultorio no encontrado'], 404);
            }
            return redirect()->route('admin.consultorios.index')
                ->with('mensaje', 'Consultorio no encontrado')
                ->with('icono', 'error');
        }

        $consultorio->delete();

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json(['status' => 'success', 'message' => 'Consultorio Eliminado']);
        }

        return redirect()->route('admin.consultorios.index')
            ->with('mensaje', 'Consultorio Eliminado')
            ->with('icono', 'success');
    }
}
