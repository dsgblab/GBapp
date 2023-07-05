<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * verifies that the user has sufficient permissions to access the methods
     */
    public function __construct()
    {
        $this->middleware(['role_or_permission:super-administrador|permission.create'])->only('index', 'store');
        $this->middleware(['role_or_permission:super-administrador|permission.edit'])->only('index', 'update');
        $this->middleware(['role_or_permission:super-administrador|permission.destroy'])->only('index', 'destroy');
    }

    /**
     * @return Response
     */
    public function index()
    {
        $permissions = Permission::with('roles')->get();

        return Inertia::render('Permissions', [
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
            Permission::create(['name' => $request->name]);
            DB::commit();

            $permissions = Permission::with('roles')->get();
            return response()->json($permissions, 200);
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
            $permission = Permission::findById($id);
            $permission->name = $request->name;
            $permission->save();

            DB::commit();

            $permissions = Permission::with('roles')->get();
            return response()->json($permissions, 200);
        }catch (\Exception $e){
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
        DB::beginTransaction();
        try {
            Permission::destroy($id);
            DB::commit();

            $permissions = Permission::with('roles')->get();
            return response()->json($permissions, 200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }
}
