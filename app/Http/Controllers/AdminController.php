<?php

namespace App\Http\Controllers;

use App\Models\consultorio;
use App\Models\Doctor;
use App\Models\Event;
use App\Models\paciente;
use App\Models\Secretaria;
use App\Models\User;
use App\Models\Horario;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $total_usuarios=User::count();
        $total_secretarias=Secretaria::count();
        $total_pacientes = Paciente::count();
        $total_consultorios= consultorio::count();
        $total_doctores= Doctor::count();
        $total_horarios= Horario::count();
        $total_eventos= Event::count();

        $consultorios = Consultorio::all();
        $doctores = Doctor::all();
        $eventos = Event::all();

        return view('admin.index', compact('total_usuarios','total_secretarias','total_pacientes',
        'total_consultorios','total_doctores', 'total_horarios', 'consultorios', 'doctores', 'eventos','total_eventos'));

    }
    public function ver_reservas($id){
        $eventos = Event::where('users_id', $id)->get();
        return view('admin.ver_reservas', compact('eventos'));
    }
}
