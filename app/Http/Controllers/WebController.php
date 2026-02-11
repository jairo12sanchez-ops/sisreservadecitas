<?php

namespace App\Http\Controllers;

use App\Models\consultorio;
use App\Models\configuracione;
use App\Models\Event;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class WebController extends Controller
{
    public function index(){
        $consultorios = Consultorio::all();
        $configuracion = configuracione::first();
        return view('index', compact('consultorios', 'configuracion'));
    }

    public function cargar_datos_consultorios($id){

        $consultorio =consultorio::find($id);
        try{
            $horarios = Horario::with('doctor','consultorio')->where('consultorio_id',$id)->get();
            //print_r($horarios);
            return view('cargar_datos_consultorio', compact('horarios','consultorio'));
        }catch (\Exception $exception){
            return response()->json(['mensaje' => 'Error en el servidor']);
        }
    }
    public function cargar_reserva_doctores($id){
        try{
            $eventos = Event::where('doctor_id',$id)
                ->select('id','title', DB::raw('DATE_FORMAT(start, "%Y-%m-%d") as start'), DB::raw('DATE_FORMAT(end, "%Y-%m-%d") as end'),'color')
                ->get();
            //print_r($horarios);
            return response()->json($eventos);
        }catch (\Exception $exception){
            return response()->json(['mensaje' => 'Error en el servidor']);
        }
    }
}
