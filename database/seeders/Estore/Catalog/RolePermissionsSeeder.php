<?php

namespace Database\Seeders\Estore\Catalog;

use App\Enums\User\UserPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (UserPermission::cases() as $permission) {
            Permission::firstOrCreate(['name' => $permission->name]);
        }

        foreach (config('role_permissions') as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);

            $rolePermissions = array_map(function($permission) {
                return $permission->name;
            }, $rolePermissions);
            $role->syncPermissions(Permission::whereIn('name', $rolePermissions)->get());
        }
    }
}
