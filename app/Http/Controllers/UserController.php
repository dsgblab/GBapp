<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\TypeDocumentIdentification;
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
     * verifies that the user has sufficient permissions to access the methods
     */
    public function __construct()
    {
        $this->middleware(['role_or_permission:super-administrador|user.create'])->except('update', 'destroy');
        $this->middleware(['role_or_permission:super-administrador|user.edit'])->except('store', 'destroy');
        $this->middleware(['role_or_permission:super-administrador|user.destroy'])->only('update', 'store');
    }

    /**
     * @return Response
     */
    public function index()
    {
        $users = User::with('roles', 'permissions', 'reports', 'type_identification')->get();
        $roles = Role::all();
        $permissions = Permission::all();
        $reports = Report::all();
        $type_document_identifications = TypeDocumentIdentification::all();

        return Inertia::render('Users', [
            'users' => $users,
            'roles' => $roles,
            'permissions' => $permissions,
            'reports' => $reports,
            'type_document_identifications' => $type_document_identifications,
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = new User($request->except('reports', 'permissions', 'roles', 'password', 'confirm_password'));
            $user->password = bcrypt($request->password);
            $user->save();
            $user->reports()->sync($request->reports);
            $user->syncPermissions($request->permissions);
            $user->syncRoles($request->roles);

            DB::commit();

            $users = User::with('roles', 'permissions', 'reports', 'type_identification')->get();

            return response()->json($users, 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);

            $user->update([
                'document' => $request->document,
                'type_document_identification_id' => $request->type_document_identification_id,
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ]);

            if ($request->change_password) {
                $user->password = $request->password;
            }

            $user->save();

            $user->reports()->sync($request->reports);
            $user->syncPermissions($request->permissions);
            $user->syncRoles($request->roles);

            DB::commit();

            $users = User::with('roles', 'permissions', 'reports', 'type_identification')->get();

            return response()->json($users, 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @return JsonResponse
     */
    public function destroy($id)
    {
        User::destroy($id);

        $users = User::with('roles', 'permissions', 'reports', 'type_identification')->get();

        return response()->json($users, 200);
    }
}
