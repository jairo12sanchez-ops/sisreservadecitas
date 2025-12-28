<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\consultorio;
use App\Models\Doctor;
use App\Models\Secretaria;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([RoleSeeder::class,]);
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make(value: '12345678')
        ])->assignRole('admin');
        User::create([
            'name' => 'Secretaria',
            'email' => 'secretaria@admin.com',
            'password' => Hash::make(value: '12345678')
        ])->assignRole('secretaria');

        Secretaria::create([
            'nombres' => 'secretaria',
            'apellidos' => '1',
            'di' => '111111',
            'telefono' => '7777777',
            'fecha de nacimiento' => '12/10/1980',
            'direccion' => 'calle 4 # 34-78',
            'users_id'=>'2',
        ]);

        User::create([
            'name' => 'Doctor1',
            'email' => 'doctor1@admin.com',
            'password' => Hash::make(value: '12345678')
        ])->assignRole('doctor');
        Doctor::create([
            'nombres' => 'Doctor1',
            'apellidos' => 'Gutierrez',
            'telefono' => '46577980',
            'licencia_medica' => '566879',
            'especialidad' => 'Ortodoncia',
            'users_id'=>'3',
        ]);

        User::create([
            'name' => 'Doctor2',
            'email' => 'doctor2@admin.com',
            'password' => Hash::make(value: '12345678')
        ])->assignRole('doctor');

        Doctor::create([
            'nombres' => 'Doctor2',
            'apellidos' => 'Sanchez',
            'telefono' => '46577987',
            'licencia_medica' => '56687945',
            'especialidad' => 'Odontologia',
            'users_id'=>'4',
        ]);
        User::create([
            'name' => 'Doctor3',
            'email' => 'doctor3@admin.com',
            'password' => Hash::make(value: '12345678')
        ])->assignRole('doctor');
        Doctor::create([
            'nombres' => 'Doctor3',
            'apellidos' => 'Arrieta',
            'telefono' => '46577980',
            'licencia_medica' => '566879',
            'especialidad' => 'Higienista',
            'users_id'=>'5',
        ]);

        consultorio::create([
            'nombre' => 'ORTODONCIA',
            'ubicacion' => '1-1A',
            'capacidad' => '10',
            'telefono'=>'EXT 4',
            'especialidad' => 'ORTODONCIA',
            'estado' => 'ACTIVO',
        ]);
        consultorio::create([
            'nombre' => 'ODONTOLOGIA GENERAL',
            'ubicacion' => '1-1B',
            'capacidad' => '10',
            'telefono'=>'EXT 5',
            'especialidad' => 'ODONTOLOGIA',
            'estado' => 'ACTIVO',
        ]);
        consultorio::create([
            'nombre' => 'ENDODONCIA',
            'ubicacion' => '1-1C',
            'capacidad' => '10',
            'telefono'=>'EXT 8',
            'especialidad' => 'ENDODONCIA',
            'estado' => 'ACTIVO',
        ]);

        User::create([
            'name' => 'Paciente1',
            'email' => 'paciente1@admin.com',
            'password' => Hash::make(value: '12345678')
        ])->assignRole('paciente');
        User::create([
            'name' => 'Usuario1',
            'email' => 'usuario1@admin.com',
            'password' => Hash::make(value: '12345678')
        ])->assignRole('usuario');

        $this->call([PacienteSeeder::class,]);
    }
}

