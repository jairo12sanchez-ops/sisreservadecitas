<?php

namespace App\Http\Controllers;

use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SecretariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {$secretarias = Secretaria::with('user')->get();
        return view('admin.secretarias.index', compact('secretarias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.secretarias.create');
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
            'di' => 'required | unique:secretarias',
            'telefono' => 'required',
            'fecha_nacimiento' => 'required',
            'direccion' => 'required',
            'email' => 'required | max:250|unique:users',
            'password' => 'required | max:250|confirmed',
        ]);

        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();

        $secretaria = new Secretaria();
        $secretaria->users_id =$usuario->id;
        $secretaria->nombres =$request->nombres;
        $secretaria->apellidos =$request->apellidos;
        $secretaria-> di = $request->di;
        $secretaria->telefono= $request->telefono;
        $secretaria->fecha_nacimiento= $request->fecha_nacimiento;
        $secretaria->direccion = $request->direccion;
        $secretaria->save();

        $usuario->assignRole('secretaria');

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => '¡se registro correctamente!',
                'secretaria' => $secretaria->load('user')
            ], 201);
        }

         return redirect()->route('admin.secretarias.index')
             ->with('mensaje', '¡se registro correctamente!')
             ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $secretaria = Secretaria::with('user')->findOrFail($id);
        return view('admin.secretarias.show', compact('secretaria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $secretaria = Secretaria::with('user')->findOrFail($id);
        return view('admin.secretarias.edit', compact('secretaria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $secretaria = Secretaria::find($id);

        if (!$secretaria) {
            if (request()->wantsJson() || request()->is('api/*')) {
                return response()->json(['status' => 'error', 'message' => 'Secretaria no encontrada'], 404);
            }
            return redirect()->route('admin.secretarias.index')
                ->with('mensaje', 'Secretaria no encontrada')
                ->with('icono', 'error');
        }

        $request->validate([
            'nombres' => 'sometimes|required',
            'apellidos' => 'sometimes|required',
            'di' => 'sometimes|required|unique:secretarias,di,' . $secretaria->id,
            'telefono' => 'sometimes|required',
            'fecha_nacimiento' => 'sometimes|required',
            'direccion' => 'sometimes|required',
            'email' => 'sometimes|required|max:250|unique:users,email,'.$secretaria->user->id,
            'password' => 'nullable|max:250|confirmed',
        ]);

        $secretaria->nombres = $request->input('nombres', $secretaria->nombres);
        $secretaria->apellidos = $request->input('apellidos', $secretaria->apellidos);
        $secretaria->di = $request->input('di', $secretaria->di);
        $secretaria->telefono = $request->input('telefono', $secretaria->telefono);
        $secretaria->fecha_nacimiento = $request->input('fecha_nacimiento', $secretaria->fecha_nacimiento);
        $secretaria->direccion = $request->input('direccion', $secretaria->direccion);
        $secretaria->save();

        $usuario = User::find($secretaria->user->id);
        $usuario->name = $request->input('nombres', $usuario->name);
        $usuario->email = $request->input('email', $usuario->email);
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->save();

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => '¡se actualizó correctamente!',
                'secretaria' => $secretaria->load('user')
            ]);
        }

        return redirect()->route('admin.secretarias.index')
            ->with('mensaje', '¡se actualizó correctamente!')
            ->with('icono', 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete($id){
        $secretaria =Secretaria::with('user')->findOrFail($id);
        return view('admin.secretarias.delete', compact('secretaria'));
    }
    public function destroy($id)
    {
        $secretaria = Secretaria::find($id);
        if (!$secretaria) {
            if (request()->wantsJson() || request()->is('api/*')) {
                return response()->json(['status' => 'error', 'message' => 'Secretaria no encontrada'], 404);
            }
            return redirect()->route('admin.secretarias.index')
                ->with('mensaje', 'Secretaria no encontrada')
                ->with('icono', 'error');
        }

        //eliminar al usuario asociado
        $user = $secretaria->user;
        if ($user) {
            $user->delete();
        }
        //eliminar a la secretaria
        $secretaria->delete();

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json(['status' => 'success', 'message' => 'se elimino correctamente!']);
        }

        return redirect()->route('admin.secretarias.index')
            ->with('mensaje', 'se elimino correctamente!')
            ->with('icono', 'success');
    }
}
