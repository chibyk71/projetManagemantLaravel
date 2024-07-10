<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'view projects',
            'create projects',
            'edit projects',
            'delete projects',
            'publish projects',
            'unpublish projects',
            'view milestones',
            'create milestones',
            'edit milestones',
            'delete milestones',
            'publish milestones',
            'unpublish milestones',
            'view files',
            'create files',
            'edit files',
            'delete files',
            'publish files',
            'unpublish files',
            'view users',
            'create users',
            'edit users',
            'delete users'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create roles and assign existing permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $moderator = Role::create(['name' => 'moderator']);
        $moderator->givePermissionTo([
            'view projects',
            'edit projects',
            'delete projects',
            'publish projects',
            'unpublish projects',
        ]);

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo([
            'view projects',
        ]);
    }
}
