<?php

namespace App\Http\Controllers;

use App\Models\Configuracione;
use App\Models\Doctor;
use App\Models\Event;
use App\Models\Historial;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $nro_documento = $request->get('nro_documento');

        $query = Historial::with('paciente', 'doctor');

        if ($nro_documento) {
            // Si hay búsqueda, filtrar por documento del paciente (todos pueden ver el resultado si buscan)
            // Usamos whereHas para filtrar por la relación del paciente
            $query->whereHas('paciente', function($q) use ($nro_documento) {
                $q->where('di', 'like', "%$nro_documento%");
            });
        } else {
            // Si NO hay búsqueda, aplicar filtro por rol
            if (Auth::user()->doctor) {
                $query->where('doctor_id', Auth::user()->doctor->id);
            } else {
                // Si es Admin o Secretaria, por defecto no ver nada (solo verán si buscan)
                // Forzamos una consulta vacía
                $query->whereRaw('1 = 0');
            }
        }

        $historiales = $query->get();

        return view('admin.historial.index', compact('historiales', 'nro_documento'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pacientes = Paciente::orderBy('apellidos','asc')->get();
        $doctores = Doctor::orderBy('apellidos','asc')->get();
        return view('admin.historial.create',compact('pacientes','doctores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos= request()->all();
        //return response()->json($datos);
        $historial = new Historial();
        $historial->detalle = $request->detalle;
        $historial->fecha_visita = $request->fecha_visita;
        $historial->paciente_id = $request->paciente_id;

        if (Auth::user()->doctor) {
            $historial->doctor_id = Auth::user()->doctor->id;
        } else {
            // Validar que se haya enviado el doctor_id si el usuario no es doctor
            $request->validate([
                'doctor_id' => 'required|exists:doctors,id',
            ]);
            $historial->doctor_id = $request->doctor_id;
        }

        $historial->save();

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Historial agregado correctamente',
                'historial' => $historial
            ], 201);
        }

        return redirect()->route('admin.historial.index')
        ->with('mensaje','Historial agregado correctamente')
        ->with('icono','success');


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $historial = Historial::find($id);
        return view('admin.historial.show',compact('historial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $historial = Historial::find($id);
        $pacientes = Paciente::orderBy('apellidos','asc')->get();
        return view('admin.historial.edit',compact('historial','pacientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$datos= request()->all();
        //return response()->json($datos);
        $historial = Historial:: find($id);
        $historial->detalle = $request->detalle;
        $historial->fecha_visita = $request->fecha_visita;
        $historial->paciente_id = $request->paciente_id;
        //$historial->doctor_id = Auth::user()->doctor->id;
        $historial->save();

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Historial actualizado correctamente',
                'historial' => $historial
            ]);
        }

        return redirect()->route('admin.historial.index')
            ->with('mensaje','Historial actualizado correctamente')
            ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function confirmDelete($id){
        $historial = Historial::find($id);
        return view('admin.historial.delete',compact('historial'));
    }
    public function destroy($id)
    {
        $historial = Historial::find($id);
        if (!$historial) {
            if (request()->wantsJson() || request()->is('api/*')) {
                return response()->json(['status' => 'error', 'message' => 'Historial no encontrado'], 404);
            }
            return redirect()->route('admin.historial.index')
                ->with('mensaje', 'Historial no encontrado')
                ->with('icono', 'error');
        }

        $historial->delete();

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json(['status' => 'success', 'message' => 'Historial eliminado correctamente']);
        }

        return redirect()->route('admin.historial.index')
            ->with('mensaje', 'Historial eliminado correctamente')
            ->with('icono', 'success');
    }

    public function pdf($id)
    {
        $configuracion = Configuracione::latest()->first();
        $historial = Historial::find($id);

        $pdf = \PDF::loadView('admin.historial.pdf', compact('configuracion','historial'));

        // Incluir la numeración de páginas y el pie de página
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: ".Auth::user()->email, null, 10, array(0,0,0));
        $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0,0,0));
        $canvas->page_text(450, 800, "Fecha: " . \Carbon\Carbon::now()->format('d/m/Y')." - ".\Carbon\Carbon::now('America/Bogota')->format('H:i:s'), null, 10, array(0,0,0));

        return $pdf->stream();
    }

    public function buscar_paciente (Request $request){
        $di = $request->di;
        $paciente =Paciente::where('di',$di)->first();
return view('admin.historial.buscar_paciente',compact('paciente'));
    }
    public function imprimir_historial($id){
        $configuracion = Configuracione::latest()->first();

        $paciente = Paciente::find($id);

        $historiales = Historial::where('paciente_id',$id)->get();

        $pdf = \PDF::loadView('admin.historial.imprimir_historial', compact('configuracion','historiales','paciente'));

        // Incluir la numeración de páginas y el pie de página
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: ".Auth::user()->email, null, 10, array(0,0,0));
        $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0,0,0));
        $canvas->page_text(450, 800, "Fecha: " . \Carbon\Carbon::now()->format('d/m/Y')." - ".\Carbon\Carbon::now('America/Bogota')->format('H:i:s'), null, 10, array(0,0,0));

        return $pdf->stream();
    }
}
