<?php

namespace App\Http\Controllers;

use App\Models\configuracione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfiguracioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $configuraciones=configuracione::all();
       return view('admin.configuracion.index',compact('configuraciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.configuracion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // $datos = request()->all();
       // return response()->json($datos);
        $request->validate([
            'nombre'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'correo'=>'required',
            'logo'=>'required',
        ]);

        $configuracion = new configuracione();

        $configuracion->nombre = $request->nombre;
        $configuracion->direccion = $request->direccion;
        $configuracion->telefono = $request->telefono;
        $configuracion->correo = $request->correo;
        $configuracion->logo = $request->file('logo')->store('logos', 'public');

        $configuracion->save();

        return redirect()->route('admin.configuraciones.index')
            ->with('mensaje','Configuracion agregada')
            ->with('icono','success');


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $configuracion = Configuracione::find($id);
        return view('admin.configuracion.show',compact('configuracion'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $configuracion = Configuracione::find($id);
        return view('admin.configuracion.edit',compact('configuracion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'correo'=>'required',
        ]);
        $configuracion = configuracione:: find($id);

        $configuracion->nombre = $request->nombre;
        $configuracion->direccion = $request->direccion;
        $configuracion->telefono = $request->telefono;
        $configuracion->correo = $request->correo;

        if($request->hasFile('logo')) {
            Storage::disk('public')->delete($configuracion->logo);
            $configuracion->logo = $request->file('logo')->store('logos', 'public');
        }
        $configuracion->save();

        return redirect()->route('admin.configuraciones.index')
            ->with('mensaje','se actualizo correctamente!')
            ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function confirmDelete($id)
    {
        $configuracion = Configuracione::find($id);
        return view('admin.configuracion.delete',compact('configuracion'));
    }
    public function destroy($id)
    {
        $configuracion = configuracione::find($id);
        Storage::disk('public')->delete($configuracion->logo);
        $configuracion->delete($id);
        return redirect()->route('admin.configuraciones.index')
            ->with('mensaje','Configuracion eliminada!')
            ->with('icono','success');
    }
}
