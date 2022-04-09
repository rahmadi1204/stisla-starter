<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $title = "Hak Akses Pengguna";
        $role = Role::with(['permissions'])->where('name', '!=', 'developer')->get();
        $permission = Permission::where('name', '!=', 'dev access')->orderBy('name')->pluck('name', 'id');
        return view('page.role.role_index', compact(['title', 'role', 'permission']));
    }
    public function add(Request $request)
    {

        $role = Role::where('name', $request->role)->first();
        $permission = Permission::where('name', $request->permission)->first();
        $message = 'add permission ' . $role->name . 'to ' . $request->permission;
        try {
            $role->givePermissionTo(
                $permission
            );

            return response()->json('success');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json('error');
        }
    }
    public function remove(Request $request)
    {
        $role = Role::where('name', $request->role)->first();
        $permission = Permission::where('name', $request->permission)->first();
        $message = 'remove permission ' . $role->name . 'to ' . $request->permission;
        try {
            $role->revokePermissionTo(
                $permission
            );

            return response()->json('success');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json('error');
        }

    }
}
