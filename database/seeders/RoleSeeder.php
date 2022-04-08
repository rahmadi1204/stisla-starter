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
        $userAccess = Permission::updateOrCreate(['name' => 'user access']);
        $userCreate = Permission::updateOrCreate(['name' => 'user create']);
        $userUpdate = Permission::updateOrCreate(['name' => 'user update']);
        $userChange = Permission::updateOrCreate(['name' => 'user change']);
        $userDelete = Permission::updateOrCreate(['name' => 'user delete']);
        $roleAccess = Permission::updateOrCreate(['name' => 'role access']);
        $roleChange = Permission::updateOrCreate(['name' => 'role change']);

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
            $userAccess,
            $userCreate,
            $userUpdate,
            $userChange,
            $userDelete,
            $roleAccess,
            $roleChange,
        ]);
        $suRole->syncPermissions([
            $suAccess,
            $adminAccess,
            $userAccess,
            $userAccess,
            $userCreate,
            $userUpdate,
            $roleAccess,
            $roleChange,
        ]);
        $adminRole->syncPermissions([
            $adminAccess,
            $userAccess,
            $userAccess,
            $userCreate,
            $userUpdate,
        ]);
    }
}
