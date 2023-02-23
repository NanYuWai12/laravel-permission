<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::get();

        return view('roles.create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        DB::beginTransaction();

        try {
            $role = Role::create([
                'name' => $request->role,
            ]);
            $role->syncPermissions($request->permissions);

            DB::commit();

            return to_route('roles.index')->with(['message' => 'Role & Permission created successfully!']);

        } catch (Throwable $th) {
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '[line:' . __LINE__ . '][Role creating failed] Message:' . $th->getMessage());
            DB::rollBack();

            return to_route('roles.index')->with(['message' => 'Role creating failed']);
        }

    }

    public function edit($id)
    {
        DB::beginTransaction();

        try {
            $role = Role::with('permissions')->findOrFail($id);
            $permissions = Permission::get();

            DB::commit();

            return view('roles.edit', compact('role', 'permissions'));

        } catch (Throwable $th) {
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '[line:' . __LINE__ . '][Role editing page failed] Message:' . $th->getMessage());
            DB::rollBack();

            return to_route('roles.index')->with(['message' => 'Role editing page failed']);
        }
    }

    public function update(RoleRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $role = Role::findOrFail($id);

            $role->update([
                'name' => $request->role,
            ]);
            $role->syncPermissions($request->permissions);

            DB::commit();

            return to_route('roles.index')->with(['message' => 'Role & Permission updated successfully!']);

        } catch (Throwable $th) {
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '[line:' . __LINE__ . '][Role updating failed] Message:' . $th->getMessage());
            DB::rollBack();

            return to_route('roles.index')->with(['message' => 'Role updating failed']);
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return back()->with(['message' => 'Role & Permission deleted successfully!']);
    }
}
