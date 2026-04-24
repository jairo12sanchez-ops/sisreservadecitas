<?php

namespace Database\Seeders;

use App\Models\Configuracione;
use App\Models\Consultorio;
use App\Models\Doctor;
use App\Models\Horario;
use App\Models\Secretaria;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([RoleSeeder::class]);

        $adminUser = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            ['name' => 'Administrador', 'password' => Hash::make('12345678')]
        );
        $adminUser->syncRoles('admin');

        $secretariaUser = User::firstOrCreate(
            ['email' => 'secretaria@admin.com'],
            ['name' => 'Secretaria', 'password' => Hash::make('12345678')]
        );
        $secretariaUser->syncRoles('secretaria');

        Secretaria::firstOrCreate(
            ['di' => '111111'],
            [
                'nombres'         => 'secretaria',
                'apellidos'       => '1',
                'telefono'        => '7777777',
                'fecha_nacimiento'=> '12/10/1980',
                'direccion'       => 'calle 4 # 34-78',
                'users_id'        => $secretariaUser->id,
            ]
        );

        $doctor1User = User::firstOrCreate(
            ['email' => 'doctor1@admin.com'],
            ['name' => 'Doctor1', 'password' => Hash::make('12345678')]
        );
        $doctor1User->syncRoles('doctor');
        Doctor::firstOrCreate(
            ['licencia_medica' => '566879'],
            [
                'nombres'     => 'Doctor1',
                'apellidos'   => 'Gutierrez',
                'telefono'    => '46577980',
                'especialidad'=> 'Ortodoncia',
                'users_id'    => $doctor1User->id,
            ]
        );

        $doctor2User = User::firstOrCreate(
            ['email' => 'doctor2@admin.com'],
            ['name' => 'Doctor2', 'password' => Hash::make('12345678')]
        );
        $doctor2User->syncRoles('doctor');
        Doctor::firstOrCreate(
            ['licencia_medica' => '56687945'],
            [
                'nombres'     => 'Doctor2',
                'apellidos'   => 'Sanchez',
                'telefono'    => '46577987',
                'especialidad'=> 'Odontologia',
                'users_id'    => $doctor2User->id,
            ]
        );

        $doctor3User = User::firstOrCreate(
            ['email' => 'doctor3@admin.com'],
            ['name' => 'Doctor3', 'password' => Hash::make('12345678')]
        );
        $doctor3User->syncRoles('doctor');
        Doctor::firstOrCreate(
            ['licencia_medica' => '5668792'],
            [
                'nombres'     => 'Doctor3',
                'apellidos'   => 'Arrieta',
                'telefono'    => '46577980',
                'especialidad'=> 'Higienista',
                'users_id'    => $doctor3User->id,
            ]
        );

        Consultorio::firstOrCreate(
            ['nombre' => 'ORTODONCIA'],
            ['ubicacion' => '1-1A', 'capacidad' => '10', 'telefono' => 'EXT 4', 'especialidad' => 'ORTODONCIA', 'estado' => 'ACTIVO']
        );
        Consultorio::firstOrCreate(
            ['nombre' => 'ODONTOLOGIA GENERAL'],
            ['ubicacion' => '1-1B', 'capacidad' => '10', 'telefono' => 'EXT 5', 'especialidad' => 'ODONTOLOGIA', 'estado' => 'ACTIVO']
        );
        Consultorio::firstOrCreate(
            ['nombre' => 'ENDODONCIA'],
            ['ubicacion' => '1-1C', 'capacidad' => '10', 'telefono' => 'EXT 8', 'especialidad' => 'ENDODONCIA', 'estado' => 'ACTIVO']
        );

        $paciente1User = User::firstOrCreate(
            ['email' => 'paciente1@admin.com'],
            ['name' => 'Paciente1', 'password' => Hash::make('12345678')]
        );
        $paciente1User->syncRoles('paciente');

        $usuario1User = User::firstOrCreate(
            ['email' => 'usuario1@admin.com'],
            ['name' => 'Usuario1', 'password' => Hash::make('12345678')]
        );
        $usuario1User->syncRoles('usuario');


        Horario::firstOrCreate(
            ['dia' => 'LUNES', 'doctor_id' => $doctor1User->id],
            ['hora_inicio' => '08:00', 'hora_fin' => '14:00', 'consultorio_id' => 1]
        );

        Configuracione::firstOrCreate(
            ['nombre' => 'Clinica Odoes'],
            [
                'direccion' => 'avenida circunvalar # 20n 30',
                'telefono'  => '45678879',
                'correo'    => 'jairo23@gmail.com',
                'logo'      => 'logos/k19bnpxJT7X75jkeAVtp5AH9zSV2viw0BOYGvqZC.jpg',
            ]
        );
    }
}
