<?php

namespace App\Http\Controllers;

use App\Models\paciente;
use App\Models\pago;
use App\Models\Doctor;
use App\Models\configuracione;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;
class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $pagos=pago::all();
        $total_monto = Pago::sum('monto');
        return view('admin.pagos.index',compact('pagos', 'total_monto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $pacientes = Paciente::orderBy('apellidos','asc')->get();
        $doctores = Doctor::orderBy('apellidos','asc')->get();
        return view('admin.pagos.create',compact('pacientes','doctores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
         //return response()->json($datos);
        $request->validate([
            'monto' => 'required',
            'fecha_pago' => 'required',
            'descripcion' => 'required',
        ]);
        $pago = new pago();
        $pago->monto = $request->monto;
        $pago->fecha_pago = $request->fecha_pago;
        $pago->descripcion = $request->descripcion;
        $pago->paciente_id = $request->paciente_id;
        $pago->doctor_id = $request->doctor_id;
        $pago->save();
        return redirect()->route('admin.pagos.index')
        ->with('mensaje','pago creado con exito')
            ->with('icono','success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id){
        $pago = Pago::find($id);
        return view('admin.pagos.show',compact('pago'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pago = pago::find($id);
        $pacientes = Paciente::orderBy('apellidos','asc')->get();
        $doctores = Doctor::orderBy('apellidos','asc')->get();
        return view('admin.pagos.edit',compact('pago','pacientes','doctores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){
        //$datos = request()->all();
        //return response()->json($datos);
        $request->validate([
            'monto' => 'required',
            'fecha_pago' => 'required',
            'descripcion' => 'required',
        ]);
        $pago = pago:: find($id);
        $pago->monto = $request->monto;
        $pago->fecha_pago = $request->fecha_pago;
        $pago->descripcion = $request->descripcion;
        $pago->paciente_id = $request->paciente_id;
        $pago->doctor_id = $request->doctor_id;
        $pago->save();
        return redirect()->route('admin.pagos.index')
            ->with('mensaje','pago actualizado  con exito')
            ->with('icono','success');

    }


    public function confirmDelete($id){
        $pago = pago::find($id);
        return view('admin.pagos.delete',compact('pago'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        Pago :: destroy($id);
        return redirect()->route('admin.pagos.index')
            ->with('mensaje','pago eliminado con exito')
            ->with('icono','success');
    }
    public function pdf($id){
        $configuracion = Configuracione::latest()->first();

        $pago = pago::find($id);
        $data = "Codigo de seguridad del comprobante de pago del paciente"
            .$pago->paciente->apellidos."".$pago->paciente->nombres."en fecha".$pago->fecha_pago."con el monto de "
        .$pago->monto."monto".$pago->descripcion;

        //Generar el QR Code
        $qrCode = new QrCode($data);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $qrCodeBase64 = base64_encode($result->getString());

        $pdf = \PDF::loadView('admin.pagos.pdf', compact('configuracion','pago','qrCodeBase64'));

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
