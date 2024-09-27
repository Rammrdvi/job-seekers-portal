<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('edit articles');
        $adminRole->givePermissionTo('delete articles');

        $editorRole = Role::create(['name' => 'editor']);
        $editorRole->givePermissionTo('edit articles');

        $userRole = Role::create(['name' => 'user']);
        // Optionally, assign permissions to the 'user' role
    }
}
