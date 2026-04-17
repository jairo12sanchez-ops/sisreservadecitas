<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use App\Models\Configuracione;
use App\Models\Event;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class WebController extends Controller
{
    public function index(){
        $consultorios = Consultorio::all();
        $configuracion = Configuracione::first();
        return view('index', compact('consultorios', 'configuracion'));
    }

    public function cargar_datos_consultorios($id){

        $consultorio =Consultorio::find($id);
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
            $eventos = Event::where('doctor_id',$id)->get();
            
            $eventosFormateados = $eventos->map(function ($evento) {
                return [
                    'id' => $evento->id,
                    'title' => $evento->title,
                    'start' => \Carbon\Carbon::parse($evento->start)->format('Y-m-d'),
                    'end' => $evento->end ? \Carbon\Carbon::parse($evento->end)->format('Y-m-d') : null,
                    'color' => $evento->color
                ];
            });

            return response()->json($eventosFormateados);
        }catch (\Exception $exception){
            return response()->json(['mensaje' => 'Error en el servidor']);
        }
    }
}
