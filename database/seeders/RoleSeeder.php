<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar la caché de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $admin      = Role::firstOrCreate(['name' => 'admin']);
        $secretaria = Role::firstOrCreate(['name' => 'secretaria']);
        $doctor     = Role::firstOrCreate(['name' => 'doctor']);
        $paciente   = Role::firstOrCreate(['name' => 'paciente']);
        $usuario    = Role::firstOrCreate(['name' => 'usuario']);

        $permissions = [
            'admin.index'                          => [],
            // usuarios
            'admin.usuarios.index'                 => [$admin],
            'admin.usuarios.create'                => [$admin],
            'admin.usuarios.store'                 => [$admin],
            'admin.usuarios.show'                  => [$admin],
            'admin.usuarios.edit'                  => [$admin],
            'admin.usuarios.update'                => [$admin],
            'admin.usuarios.confirmDelete'         => [$admin],
            'admin.usuarios.destroy'               => [$admin],
            // configuraciones
            'admin.configuraciones.index'          => [$admin],
            'admin.configuraciones.create'         => [$admin],
            'admin.configuraciones.store'          => [$admin],
            'admin.configuraciones.show'           => [$admin],
            'admin.configuraciones.edit'           => [$admin],
            'admin.configuraciones.update'         => [$admin],
            'admin.configuraciones.confirmDelete'  => [$admin],
            'admin.configuraciones.destroy'        => [$admin],
            // secretarias
            'admin.secretarias.index'              => [$admin],
            'admin.secretarias.create'             => [$admin],
            'admin.secretarias.store'              => [$admin],
            'admin.secretarias.show'               => [$admin],
            'admin.secretarias.edit'               => [$admin],
            'admin.secretarias.update'             => [$admin],
            'admin.secretarias.confirmDelete'      => [$admin],
            'admin.secretarias.destroy'            => [$admin],
            // pacientes
            'admin.pacientes.index'                => [$admin, $secretaria],
            'admin.pacientes.create'               => [$admin, $secretaria],
            'admin.pacientes.store'                => [$admin, $secretaria],
            'admin.pacientes.show'                 => [$admin, $secretaria],
            'admin.pacientes.edit'                 => [$admin, $secretaria],
            'admin.pacientes.update'               => [$admin, $secretaria],
            'admin.pacientes.confirmDelete'        => [$admin, $secretaria],
            'admin.pacientes.destroy'              => [$admin, $secretaria],
            // consultorios
            'admin.consultorios.index'             => [$admin, $secretaria],
            'admin.consultorios.create'            => [$admin, $secretaria],
            'admin.consultorios.store'             => [$admin, $secretaria],
            'admin.consultorios.show'              => [$admin, $secretaria],
            'admin.consultorios.edit'              => [$admin, $secretaria],
            'admin.consultorios.update'            => [$admin, $secretaria],
            'admin.consultorios.confirmDelete'     => [$admin, $secretaria],
            'admin.consultorios.destroy'           => [$admin, $secretaria],
            // doctores
            'admin.doctores.index'                 => [$admin, $secretaria],
            'admin.doctores.create'                => [$admin, $secretaria],
            'admin.doctores.store'                 => [$admin, $secretaria],
            'admin.doctores.show'                  => [$admin, $secretaria],
            'admin.doctores.edit'                  => [$admin, $secretaria],
            'admin.doctores.update'                => [$admin, $secretaria],
            'admin.doctores.confirmDelete'         => [$admin, $secretaria],
            'admin.doctores.destroy'               => [$admin, $secretaria],
            'admin.doctores.reportes'              => [$admin, $secretaria],
            'admin.doctores.pdf'                   => [$admin, $secretaria],
            // horarios
            'admin.horarios.index'                 => [$admin, $secretaria],
            'admin.horarios.create'                => [$admin, $secretaria],
            'admin.horarios.store'                 => [$admin, $secretaria],
            'admin.horarios.show'                  => [$admin, $secretaria],
            'admin.horarios.edit'                  => [$admin, $secretaria],
            'admin.horarios.update'                => [$admin, $secretaria],
            'admin.horarios.confirmDelete'         => [$admin, $secretaria],
            'admin.horarios.destroy'               => [$admin, $secretaria],
            'admin.horarios.cargar_datos_consultorios' => [$admin, $secretaria],
            // ajax / reservas
            'cargar_datos_consultorios'            => [$admin, $usuario, $secretaria],
            'cargar_reserva_doctores'              => [$admin, $usuario, $secretaria],
            'ver_reservas'                         => [$admin, $usuario, $secretaria],
            'admin.eventos.create'                 => [$admin, $usuario, $secretaria],
            'admin.eventos.destroy'                => [$admin, $usuario, $secretaria],
            // reservas reportes
            'admin.reservas.reportes'              => [$admin],
            'admin.reservas.pdf'                   => [$admin],
            'admin.reservas.pdf_fechas'            => [$admin],
            // historial
            'admin.historial.index'                => [$admin, $doctor],
            'admin.historial.create'               => [$admin, $doctor],
            'admin.historial.store'                => [$admin, $doctor],
            'admin.historial.pdf'                  => [$admin, $doctor],
            'admin.historial.show'                 => [$admin, $doctor],
            'admin.historial.edit'                 => [$admin, $doctor],
            'admin.historial.update'               => [$admin, $doctor],
            'admin.historial.confirmDelete'        => [$admin, $doctor],
            'admin.historial.destroy'              => [$admin, $doctor],
            'admin.historial.buscar_paciente'      => [$admin, $doctor],
            'admin.historial.imprimir_historial'   => [$admin, $doctor],
            // pagos
            'admin.pagos.index'                    => [$admin, $secretaria],
            'admin.pagos.create'                   => [$admin, $secretaria],
            'admin.pagos.store'                    => [$admin, $secretaria],
            'admin.pagos.pdf'                      => [$admin, $secretaria],
            'admin.pagos.show'                     => [$admin, $secretaria],
            'admin.pagos.edit'                     => [$admin, $secretaria],
            'admin.pagos.update'                   => [$admin, $secretaria],
            'admin.pagos.confirmDelete'            => [$admin, $secretaria],
            'admin.pagos.destroy'                  => [$admin, $secretaria],
        ];

        foreach ($permissions as $name => $roles) {
            $perm = Permission::firstOrCreate(['name' => $name]);
            if (!empty($roles)) {
                $perm->syncRoles($roles);
            }
        }
    }
}
