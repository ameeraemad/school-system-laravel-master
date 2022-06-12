<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Permission::create(['name' => 'Create-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Role', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Permission', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Parent', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Parents', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Parent', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Parent', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Student', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Students', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Student', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Student', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Teacher', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Teachers', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Teacher', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Teacher', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-City', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Cities', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-City', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-City', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Class', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Class', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Class', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Class', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-School', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-School', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-School', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-School', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Subject', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Subject', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Subject', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Subject', 'guard_name' => 'admin']);

        //-----------------------------
        Permission::create(['name' => 'Create-Parent', 'guard_name' => 'school']);
        Permission::create(['name' => 'Read-Parents', 'guard_name' => 'school']);
        Permission::create(['name' => 'Update-Parent', 'guard_name' => 'school']);
        Permission::create(['name' => 'Delete-Parent', 'guard_name' => 'school']);

        Permission::create(['name' => 'Create-Student', 'guard_name' => 'school']);
        Permission::create(['name' => 'Read-Students', 'guard_name' => 'school']);
        Permission::create(['name' => 'Update-Student', 'guard_name' => 'school']);
        Permission::create(['name' => 'Delete-Student', 'guard_name' => 'school']);

        Permission::create(['name' => 'Create-Teacher', 'guard_name' => 'school']);
        Permission::create(['name' => 'Read-Teachers', 'guard_name' => 'school']);
        Permission::create(['name' => 'Update-Teacher', 'guard_name' => 'school']);
        Permission::create(['name' => 'Delete-Teacher', 'guard_name' => 'school']);

        Permission::create(['name' => 'Read-Classes', 'guard_name' => 'school']);
        Permission::create(['name' => 'Read-Subjects', 'guard_name' => 'school']);

        Permission::create(['name' => 'Create-School-Class', 'guard_name' => 'school']);
        Permission::create(['name' => 'Read-School-Classes', 'guard_name' => 'school']);
        Permission::create(['name' => 'Update-School-Class', 'guard_name' => 'school']);
        Permission::create(['name' => 'Delete-School-Class', 'guard_name' => 'school']);

        Permission::create(['name' => 'Create-School-Class-Student', 'guard_name' => 'school']);
        Permission::create(['name' => 'Read-School-Class-Student', 'guard_name' => 'school']);
    }
}
