<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Створення ролі адміністратора з guard_name 'admin'
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'admin']);

        // Створення дозволу з guard_name 'admin'
        $dashboardPermission = Permission::firstOrCreate(['name' => 'access dashboard', 'guard_name' => 'admin']);

        // Приклад створення адміністратора
        $admin = Admin::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Admin User',
            'password' => bcrypt('password'),
        ]);

        // Призначення ролі адміністратора
        $admin->assignRole('admin');
    }
}
