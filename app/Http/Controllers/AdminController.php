<?php

namespace App\Http\Controllers;

use App\Models\consultorio;
use App\Models\Doctor;
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
        return view('admin.index', compact('total_usuarios','total_secretarias','total_pacientes',
        'total_consultorios','total_doctores', 'total_horarios'));

    }
}
