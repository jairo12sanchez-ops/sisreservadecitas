<?php

namespace App\Http\Controllers;

use App\Models\consultorio;
use App\Models\Horario;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(){
        $consultorios = Consultorio::all();
        return view('index', compact('consultorios'));
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
}
