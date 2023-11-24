<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                "description" => "Roles – Listar",
                "name" => "role.index",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Roles – Crear",
                "name" => "role.create",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Roles – Editar",
                "name" => "role.edit",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Roles – Eliminar",
                "name" => "role.destroy",
                "guard_name" => "sanctum"
            ],

            /**
             * Users
             */
            [
                "description" => "Usuarios – Listar",
                "name" => "user.index",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Usuarios – Crear",
                "name" => "user.create",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Usuarios – Editar",
                "name" => "user.edit",
                "guard_name" => "sanctum"
            ],

            [
                "description" => "Usuarios – Eliminar",
                "name" => "user.destroy",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Usuarios – Actualizar reportes",
                "name" => "user.update-reports",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Usuarios – Actualizar filtros reporte",
                "name" => "user.report.update-filters",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Usuarios – Actualizar reporte por defecto",
                "name" => "user.report.set-default",
                "guard_name" => "sanctum"
            ],
            /**
             * Reports
             */
            [
                "description" => "Reportes – Listar",
                "name" => "report.index",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Reportes – Crear",
                "name" => "report.store",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Reportes – Actualizar",
                "name" => "report.update",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Reportes – Eliminar",
                "name" => "report.destroy",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Reportes – Visualizar",
                "name" => "report.view",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Reportes – Importar",
                "name" => "report.import",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Reportes|Filtros - Listar",
                "name" => "report.filter.index",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Reportes|Filtros - Crear",
                "name" => "report.filter.store",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Reportes|Filtros - Actualizar",
                "name" => "report.filter.update",
                "guard_name" => "sanctum"
            ],
            [
                "description" => "Reportes|Filtros - Eliminar",
                "name" => "report.filter.destroy",
                "guard_name" => "sanctum"
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        $role = Role::create([
            "description" => "Super Administrador",
            "name" => "super-admin",
            "guard_name" => "sanctum"
        ]);

        $role->syncPermissions(array_column($permissions, 'name'));
    }
}
