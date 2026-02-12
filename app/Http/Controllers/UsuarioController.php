<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(){
        $usuarios = User::all();
        return view('admin.usuarios.index',compact('usuarios'));
    }
    public function create(){
        return view('admin.usuarios.create');
    }
    public function store(Request $request){
        //$datos = request()->all();
       // return response()->json($datos);
        $request->validate([
            'name' => 'required | max:250',
            'email' => 'required | max:250 |unique:users',
            'password' => 'required | max:250 | confirmed',
        ]);
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password =Hash::make($request['password']);
        $usuario->save();

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => '¡Nuevo Usuario registrado correctamente!',
                'usuario' => $usuario
            ], 201);
        }

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', '¡Nuevo Usuario registrado correctamente!')
        ->with('icono', 'success');

    }
    public function show($id){
        $usuario = User::findOrfail($id);
        return view('admin.usuarios.show', compact('usuario'));
    }
    public function edit($id){
        $usuario = User::findOrfail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id){
        $usuario= User::find($id);

        if (!$usuario) {
            if (request()->wantsJson() || request()->is('api/*')) {
                return response()->json(['status' => 'error', 'message' => 'Usuario no encontrado'], 404);
            }
            return redirect()->route('admin.usuarios.index')
                ->with('mensaje', 'Usuario no encontrado')
                ->with('icono', 'error');
        }

        $request->validate([
            'name' => 'sometimes|required|max:250',
            'email' => 'sometimes|required|max:250|unique:users,email,'.$usuario->id,
            'password' =>'nullable|max:250|confirmed',
        ]);

        $usuario->name = $request->input('name', $usuario->name);
        $usuario->email = $request->input('email', $usuario->email);
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->save();

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Usuario actualizado correctamente!',
                'usuario' => $usuario
            ]);
        }

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario actualizado correctamente!')
            ->with('icono', 'success');
    }
        public function confirmDelete($id){
        $usuario = User::findOrfail($id);
        return view('admin.usuarios.delete', compact('usuario'));
}
    public function destroy($id)
    {
        $usuario = User::find($id);
        if (!$usuario) {
            if (request()->wantsJson() || request()->is('api/*')) {
                return response()->json(['status' => 'error', 'message' => 'Usuario no encontrado'], 404);
            }
            return redirect()->route('admin.usuarios.index')
                ->with('mensaje', 'Usuario no encontrado')
                ->with('icono', 'error');
        }

        $usuario->delete();

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json(['status' => 'success', 'message' => 'Usuario eliminado correctamente!']);
        }

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario eliminado correctamente!')
            ->with('icono', 'success');
    }
    }
