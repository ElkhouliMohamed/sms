<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'manage_users']);
        Permission::create(['name' => 'manage_timetables']);
        Permission::create(['name' => 'manage_payments']);
        Permission::create(['name' => 'view_grades']);
        Permission::create(['name' => 'view_absences']);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'manage_users',
            'manage_timetables',
            'manage_payments',
            'view_grades',
            'view_absences',
        ]);

        $teacherRole = Role::create(['name' => 'teacher']);
        $teacherRole->givePermissionTo(['manage_timetables', 'view_grades', 'view_absences']);

        $accountantRole = Role::create(['name' => 'accountant']);
        $accountantRole->givePermissionTo(['manage_payments']);

        $parentRole = Role::create(['name' => 'parent']);
        $parentRole->givePermissionTo(['view_grades', 'view_absences']);

        $studentRole = Role::create(['name' => 'student']);
        $studentRole->givePermissionTo(['view_grades', 'view_absences']);

      
    }
}
