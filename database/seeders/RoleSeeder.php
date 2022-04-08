<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dev = User::where('code', 'developer')->first();
        $superadmin = User::where('code', 'superadmin')->first();
        $admin = User::where('code', 'admin')->first();

        $devAccess = Permission::updateOrCreate(['name' => 'dev access']);
        $suAccess = Permission::updateOrCreate(['name' => 'superadmin access']);
        $adminAccess = Permission::updateOrCreate(['name' => 'admin access']);
        $logAccess = Permission::updateOrCreate(['name' => 'log access']);
        $databaseAccess = Permission::updateOrCreate(['name' => 'database access']);
        $databaseChange = Permission::updateOrCreate(['name' => 'database change']);
        $databaseDelete = Permission::updateOrCreate(['name' => 'database delete']);
        $userAccess = Permission::updateOrCreate(['name' => 'user access']);
        $userChange = Permission::updateOrCreate(['name' => 'user change']);
        $userDelete = Permission::updateOrCreate(['name' => 'user delete']);
        $roleAccess = Permission::updateOrCreate(['name' => 'role access']);
        $roleChange = Permission::updateOrCreate(['name' => 'role change']);
        $roleDelete = Permission::updateOrCreate(['name' => 'role delete']);

        $devRole = Role::updateOrCreate(['name' => 'developer']);
        $suRole = Role::updateOrCreate(['name' => 'superadmin']);
        $adminRole = Role::updateOrCreate(['name' => 'admin']);

        $dev->assignRole($devRole);
        $superadmin->assignRole($suRole);
        $admin->assignRole($adminRole);

        $devRole->syncPermissions([
            $devAccess,
            $suAccess,
            $adminAccess,
            $logAccess,
            $databaseAccess,
            $databaseChange,
            $databaseDelete,
            $userAccess,
            $userChange,
            $userDelete,
            $roleAccess,
            $roleChange,
            $roleDelete,

        ]);
        $suRole->syncPermissions([
            $suAccess,
            $adminAccess,
            $databaseAccess,
            $userAccess,
            $userChange,
            $roleAccess,
            $roleChange,
        ]);
        $adminRole->syncPermissions([
            $adminAccess,
            $userAccess,
        ]);
    }
}
