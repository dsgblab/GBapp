<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportFilter;
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
        $users = User::with('roles', 'permissions', 'reports')->get();
        $roles = Role::all();
        $permissions = Permission::all();
        $reports = Report::all();

        return Inertia::render('Users/Index', [
            'users' => $users,
            'roles' => $roles,
            'permissions' => $permissions,
            'reports' => $reports,
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

            $users = User::with('roles', 'permissions', 'reports')->get();

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
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ]);

            if ($request->change_password) {
                $user->password = $request->password;
            }

            $user->save();

            $user->syncPermissions($request->permissions);
            $user->syncRoles($request->roles);

            DB::commit();

            $users = User::with('roles', 'permissions', 'reports')->get();

            return response()->json($users, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update_reports(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($request->user_id);
            $user->reports()->sync($request->reports);

            DB::commit();
            return response()->json('success', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update_filters(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::with('reports.filters')->find($request->user_id);
            $user->reports()->find($request->report_id)->filters()->syncWithPivotValues($request->filters, ['user_id' => $request->user_id]);

            DB::commit();
            return response()->json('success', 200);
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

        $users = User::with('roles', 'permissions', 'reports')->get();

        return response()->json($users, 200);
    }

    /**
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::with('roles', 'permissions', 'reports')
            ->find($id);

        $roles = Role::all();
        $permissions = Permission::all();
        $reports = Report::all();
        $filters = ReportFilter::all();

        return Inertia::render('Users/Show', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
            'reports' => $reports,
            'filters' => $filters
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function set_default(Request $request)
    {
        $user = User::find($request->user_id);

        $user->reports()->updateExistingPivot($request->report_id, [
            'show' => $request->state
        ]);

        return response()->json('success', 200);
    }
}
