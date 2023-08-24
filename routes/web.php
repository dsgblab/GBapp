<?php

use App\Http\Controllers\DesignPriorityController;
use App\Http\Controllers\DesignRequestController;
use App\Http\Controllers\DesignStateController;
use App\Http\Controllers\DesignTaskController;
use App\Http\Controllers\DesignTimeStateController;
use App\Http\Controllers\ImportReportController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportFilterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TypeDocumentIdentificationController;
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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('permissions', PermissionController::class);

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);
    Route::prefix('users')->group(function (){
        Route::post('update-reports', [UserController::class, 'update_reports'])->name('user.update-reports');
        Route::post('report/update-filters', [UserController::class, 'update_filters'])->name('user.report.update-filters');
        Route::post('report/set-default', [UserController::class, 'set_default'])->name('user.report.set-default');
    });

    Route::resource('report', ReportController::class)->only('index', 'store', 'destroy', 'update');
    Route::get('report/view/{groupId}/{reportId}', [ReportController::class, 'view'])->name('report.view');

    Route::prefix('import-report')->group(function () {
        Route::get('', [ImportReportController::class, 'index'])->name('import-report.index');
        Route::post('', [ImportReportController::class, 'store'])->name('import-report.store');
        Route::get('get-reports', [ImportReportController::class, 'get_reports'])->name('import-report.get-reports');
    });

    Route::resource('filters', ReportFilterController::class)->only('index', 'update', 'store', 'destroy');

    Route::resource('type-document-identification', TypeDocumentIdentificationController::class)->only('index', 'store', 'update', 'destroy');

    Route::prefix('design')->group(function () {
        Route::resource('request', DesignRequestController::class)->only('index', 'store', 'update', 'destroy', 'show');
        Route::post('request/update-state', [DesignRequestController::class, 'update_state'])->name('design.request.update-state');

        Route::resource('priority', DesignPriorityController::class)->only('index', 'store', 'update', 'destroy');
        Route::resource('state', DesignStateController::class)->only('index', 'store', 'update', 'destroy');
        Route::resource('time-state', DesignTimeStateController::class)->only('index', 'store', 'update', 'destroy');
        Route::resource('task', DesignTaskController::class)->only('store', 'update');
        Route::delete('task/{request_id}/{id}', [DesignTaskController::class, 'destroy'])->name('task.destroy');
    });
});
