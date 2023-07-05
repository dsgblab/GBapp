<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        $users = User::with('roles', 'permissions')->get();
        $roles = Role::all();
        $permissions = Permission::all();

        return Inertia::render('Users', [
            'users' => $users,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = new User($request->except('permissions', 'roles', 'password', 'confirm_password'));
            $user->password = bcrypt($request->password);
            $user->save();
            $user->syncPermissions($request->permissions);
            $user->syncRoles($request->roles);

            DB::commit();

            $users = User::with('roles', 'permissions')->get();
            return response()->json($users, 200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);

            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ]);

            $user->syncPermissions($request->permissions);
            $user->syncRoles($request->roles);

            DB::commit();

            $users = User::with('roles', 'permissions')->get();
            return response()->json($users, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
         User::destroy($id);

        $users = User::with('roles', 'permissions')->get();
        return response()->json($users, 200);
    }
}

