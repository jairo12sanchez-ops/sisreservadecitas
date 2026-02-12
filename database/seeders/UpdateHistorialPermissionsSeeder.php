<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdateHistorialPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('name', 'admin')->first();
        $doctor = Role::where('name', 'doctor')->first();

        $permissions = [
            'admin.historial.index',
            'admin.historial.create',
            'admin.historial.store',
            'admin.historial.pdf',
            'admin.historial.show',
            'admin.historial.edit',
            'admin.historial.update',
            'admin.historial.confirmDelete',
            'admin.historial.destroy',
            'admin.historial.buscar_paciente',
            'admin.historial.imprimir_historial',
        ];

        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            
            if ($admin) {
                $admin->givePermissionTo($permission);
            }
            if ($doctor) {
                $doctor->givePermissionTo($permission);
            }
        }
    }
}
