<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        logger('run.');
        // Створення ролі адміністратора з guard_name 'admin'
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'admin']);

        // Створення дозволу з guard_name 'admin'
        $dashboardPermission = Permission::create(['name' => 'access dashboard', 'guard_name' => 'admin']);

        // Призначення дозволу ролі адміністратора
        $adminRole->givePermissionTo($dashboardPermission);
    }
}
