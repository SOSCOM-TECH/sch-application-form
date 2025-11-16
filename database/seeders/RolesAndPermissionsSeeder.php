<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Define permissions
        $permissions = [
            'manage schools',
            'view schools',
            'manage forms',
            'view forms',
            'manage applicants',
            'view applicants',
            'manage payments',
            'view payments',
            'manage exports',
            'view reports',
            'manage roles',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $schoolRepresentativeRole = Role::firstOrCreate(['name' => 'school_representative']);

        // Assign all permissions to admin
        $adminRole->syncPermissions(Permission::all());

        // Assign a subset to school representative
        $schoolRepresentativePermissions = [
            'manage forms',
            'view forms',
            'manage applicants',
            'view applicants',
            'view payments',
            'view reports',
            'manage exports',
        ];
        $schoolRepresentativeRole->syncPermissions(Permission::whereIn('name', $schoolRepresentativePermissions)->get());
    }
}


