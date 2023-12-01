<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles          = ['developer'];
        $permissions    = ['create', 'read', 'update', 'delete'];
        $resources      = ['permissions', 'roles', 'admins'];
        $guardName      = Admin::getDefaultGuardName();

        // create permissions
        $createdPermissions = [];
        foreach ($permissions as $permission) {
            foreach ($resources as $resource) {
                $permissionName = "$permission $resource";
                $createdPermissions[]   = Permission::create([
                    'name'          => $permissionName,
                    'guard_name'    => $guardName,
                ]);
            }
        }

        // create roles ans assign the permissions to them
        $createdRoles   = [];
        foreach ($roles as $roleName) {
            $role   = Role::create([
                'name'          => $roleName,
                'guard_name'    => $guardName,
            ]);
            $role->syncPermissions($createdPermissions);
            $createdRoles[] = $role;
        }

        // create new admin and assign to him the created role
        Admin::create([
            'name'      => 'Khalid Hamza',
            'email'     => 'contact@khalidhamza.net',
            'password'  => bcrypt('123456'),
        ])->syncRoles($createdRoles);

    }
}
