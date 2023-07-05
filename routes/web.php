<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('permissions',  PermissionController::class);
    Route::get('permissions-list', [PermissionController::class, 'list'])->name('permissions.list');

    Route::resource('roles',  RoleController::class);
    Route::get('roles-list', [RoleController::class, 'list'])->name('roles.list');


    Route::resource('users',  UserController::class);

    Route::resource('report', ReportController::class)->only('index', 'store', 'destroy', 'update');
    Route::get('report/view/{groupId}/{reportId}', [ReportController::class, 'view'])->name('report.view');
});


