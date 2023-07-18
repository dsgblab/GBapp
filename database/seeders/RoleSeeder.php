<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role.create', 'role.edit', 'role.destroy',
            'user.create', 'user.edit', 'roles.destroy',
            'permission.create', 'permission.edit', 'permission.destroy',
            'report.create', 'report.edit', 'report.destroy',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'super-administrador']);
        $role->syncPermissions($permissions);

    }
}
