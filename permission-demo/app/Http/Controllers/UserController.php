<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Throwable;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();

        return view('users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make('password'),
            ]);
            $user->syncRoles($request->roles);

            DB::commit();

            return to_route('user.index')->with(['message' => 'User created successfully']);
        } catch (Throwable $th) {

            Log::error(__CLASS__ . '::' . __FUNCTION__ . '[line:' . __LINE__ . '][User creating failed] Message:' . $th->getMessage());
            DB::rollBack();

            return to_route('user.index')->with(['message' => 'User creating failed']);
        }

    }

    public function edit($id)
    {
        DB::beginTransaction();

        try {
            $user = User::with('roles')->findOrFail($id);
            $roles = Role::get();

            DB::commit();

            return view('users.edit', compact('user', 'roles'));

        } catch (Throwable $th) {

            Log::error(__CLASS__ . '::' . __FUNCTION__ . '[line:' . __LINE__ . '][User editing page failed] Message:' . $th->getMessage());
            DB::rollBack();

            return to_route('user.index')->with(['message' => 'User editing page failed']);
        }

    }

    public function update(UserRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);
            $user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);
            $user->syncRoles($request->roles);

            DB::commit();

            return to_route('user.index')->with(['message' => 'User updated successfully!']);

        } catch (Throwable $th) {
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '[line:' . __LINE__ . '][User updating failed] Message:' . $th->getMessage());
            DB::rollBack();

            return to_route('user.index')->with(['message' => 'User updating failed']);
        }

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with(['message' => 'User deleted successfully']);
    }
}
