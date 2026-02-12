<?php
namespace App\Http\Controllers;

use App\Models\configuracione;
use App\Models\Doctor;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $doctores=Doctor::with('user')->get();
        return view('admin.doctores.index', compact('doctores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres'=>'required',
            'apellidos'=>'required',
            'telefono'=>'required',
            'licencia_medica'=>'required',
            'especialidad'=>'required',
            'email' => 'required | max:250 |unique:users',
            'password' => 'required | max:250 | confirmed',
        ]);
        $usuario = new User();
        $usuario->name =$request->nombres;
        $usuario->email =$request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();

        $doctor = new Doctor();
        $doctor->users_id =$usuario->id;
        $doctor->nombres =$request->nombres;
        $doctor->apellidos =$request->apellidos;
        $doctor->telefono = $request->telefono;
        $doctor->licencia_medica= $request->licencia_medica;
        $doctor->especialidad= $request->especialidad;
        $doctor->save();

        $usuario->assignRole('doctor');

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => '¡se registro correctamente!',
                'doctor' => $doctor->load('user')
            ], 201);
        }

        return redirect()->route('admin.doctores.index')
            ->with('mensaje', '¡se registro correctamente!')
            ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id){
        $doctor=Doctor::findOrFail($id);
        return view('admin.doctores.show', compact('doctor'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        $doctor=Doctor::findOrFail($id);
        return view('admin.doctores.edit', compact('doctor'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            if (request()->wantsJson() || request()->is('api/*')) {
                return response()->json(['status' => 'error', 'message' => 'Doctor no encontrado'], 404);
            }
            return redirect()->route('admin.doctores.index')
                ->with('mensaje', 'Doctor no encontrado')
                ->with('icono', 'error');
        }

        $request->validate([
            'nombres' => 'sometimes|required',
            'apellidos' => 'sometimes|required',
            'telefono' => 'sometimes|required',
            'licencia_medica' => 'sometimes|required',
            'especialidad' => 'sometimes|required',
            'email' => 'sometimes|required|max:250|unique:users,email,'.$doctor->user->id,
            'password' => 'nullable|max:250|confirmed',
        ]);

        $doctor->nombres = $request->input('nombres', $doctor->nombres);
        $doctor->apellidos = $request->input('apellidos', $doctor->apellidos);
        $doctor->telefono = $request->input('telefono', $doctor->telefono);
        $doctor->licencia_medica = $request->input('licencia_medica', $doctor->licencia_medica);
        $doctor->especialidad = $request->input('especialidad', $doctor->especialidad);
        $doctor->save();

        $usuario = User::find($doctor->user->id);
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
                'doctor' => $doctor->load('user')
            ]);
        }

        return redirect()->route('admin.doctores.index')
            ->with('mensaje', '¡se actualizó correctamente!')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete($id){
        $doctor =Doctor::findOrFail($id);
        return view('admin.doctores.delete', compact('doctor'));
    }
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            if (request()->wantsJson() || request()->is('api/*')) {
                return response()->json(['status' => 'error', 'message' => 'Doctor no encontrado'], 404);
            }
            return redirect()->route('admin.doctores.index')
                ->with('mensaje', 'Doctor no encontrado')
                ->with('icono', 'error');
        }

        //eliminar al usuario asociado
        $user = $doctor->user;
        if ($user) {
            $user->delete();
        }
        //eliminar al doctor
        $doctor->delete();

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json(['status' => 'success', 'message' => 'se elimino correctamente!']);
        }

        return redirect()->route('admin.doctores.index')
            ->with('mensaje', 'se elimino correctamente!')
            ->with('icono', 'success');
    }
    public function reportes(){
        return view('admin.doctores.reportes');
    }
    public function pdf(){
        $configuracion = configuracione::latest()->first();
        $doctores = Doctor::all();
        $pdf = \PDF::loadView('admin.doctores.pdf', compact('configuracion','doctores'));

        // incluir la numeración de páginas y el pie de página
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: " . Auth::user()->email, null, 10, array(0, 0, 0));
        $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        $canvas->page_text(450, 800, "Fecha: " . \Carbon\Carbon::now('America/Bogota')->format('d/m/Y H:i:s'), null, 10, array(0, 0, 0));
        return $pdf->stream();
    }
}
