<?php

use App\Http\Controllers\DashboardController;
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
use App\Http\Controllers\SupplierDeliveryController;
use App\Http\Controllers\TypeDocumentIdentificationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

    /**
     * Dashboard routes
     */
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /**
     * roles
     */
    Route::prefix('roles')->group(function () {
        Route::get('', [RoleController::class, 'index'])
            ->name('roles.index')
            ->middleware('role_or_permission:super-admin|role.index|role.create|role.update|role.destroy');

        Route::post('', [RoleController::class, 'store'])
            ->name('roles.store')
            ->middleware('role_or_permission:super-admin|role.index|role.create');

        Route::put('{id}', [RoleController::class, 'update'])
            ->name('roles.update')
            ->middleware('role_or_permission:super-admin|role.index|role.update');

        Route::delete('{id}', [RoleController::class, 'destroy'])
            ->name('roles.destroy')
            ->middleware('role_or_permission:super-admin|role.index|role.destroy');
    });

    /**
     * users
     */
    Route::prefix('users')->group(function () {
        Route::get('', [UserController::class, 'index'])
            ->name('users.index')
            ->middleware('role_or_permission:super-admin|user.index|user.create|user.update|user.destroy');

        Route::get('{id}/show', [UserController::class, 'show'])
            ->name('users.show')
            ->middleware('role_or_permission:super-admin|user.index|user.show');

        Route::post('', [UserController::class, 'store'])
            ->name('users.store')
            ->middleware('role_or_permission:super-admin|user.index|user.create');

        Route::put('{id}', [UserController::class, 'update'])
            ->name('users.update')
            ->middleware('role_or_permission:super-admin|user.index|user.update');

        Route::delete('{id}', [UserController::class, 'destroy'])
            ->name('users.destroy')
            ->middleware('role_or_permission:super-admin|user.index|user.destroy');

        Route::post('update-reports', [UserController::class, 'update_reports'])
            ->name('user.update-reports')
            ->middleware('role_or_permission:super-admin|update-reports');

        Route::post('report/update-filters', [UserController::class, 'update_filters'])
            ->name('user.report.update-filters')
            ->middleware('role_or_permission:super-admin|update-filters');

        Route::post('report/set-default', [UserController::class, 'set_default'])
            ->name('user.report.set-default')
            ->middleware('role_or_permission:super-admin|set-default');
    });

    /**
     * reports
     */
    Route::prefix('reports')->group(function () {
        Route::get('', [ReportController::class, 'index'])
            ->name('report.index')
            ->middleware('role_or_permission:super-admin|report.index|report.create|report.update|report.destroy|report.view');

        Route::post('', [ReportController::class, 'store'])
            ->name('report.store')
            ->middleware('role_or_permission:super-admin|report.index|report.create');

        Route::delete('{id}', [ReportController::class, 'destroy'])
            ->name('report.destroy')
            ->middleware('role_or_permission:super-admin|report.index|report.destroy');

        Route::put('{id}', [ReportController::class, 'update'])
            ->name('report.update')
            ->middleware('role_or_permission:super-admin|report.index|report.update');

        Route::get('{groupId}/{reportId}/view', [ReportController::class, 'view'])
            ->name('report.view')
            ->middleware('role_or_permission:super-admin|report.index|report.view');


        /**
         * Import reports
         */
        Route::prefix('import')->group(function () {
            Route::get('', [ImportReportController::class, 'index'])
                ->name('report.import.index')
                ->middleware('role_or_permission:super-admin|report.import.index|report.import.create|report.import.update|report.import.destroy');

            Route::post('', [ImportReportController::class, 'store'])
                ->name('report.import.store')
                ->middleware('role_or_permission:super-admin|report.import.index|report.import.create');

            Route::get('get-reports', [ImportReportController::class, 'get_reports'])
                ->name('report.import.get-reports')
                ->middleware('role_or_permission:super-admin|report.import.index|report.import.get-reports');
        });

        /**
         * Filters
         */
        Route::prefix('filters')->group(function () {
            Route::get('', [ReportFilterController::class, 'index'])
                ->name('report.filter.index')
                ->middleware('role_or_permission:super-admin|report.filter.index|report.filter.create|report.filter.update|report.filter.destroy');

            Route::post('', [ReportFilterController::class, 'store'])
                ->name('report.filter.store')
                ->middleware('role_or_permission:super-admin|report.filter.index|report.filter.create');

            Route::delete('{id}', [ReportFilterController::class, 'destroy'])
                ->name('report.filter.destroy')
                ->middleware('role_or_permission:super-admin|report.filter.index|report.filter.destroy');

            Route::put('{id}', [ReportFilterController::class, 'update'])
                ->name('report.filter.update')
                ->middleware('role_or_permission:super-admin|report.filter.index|report.filter.update');
        });
    });


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

    Route::prefix('supplier-delivery')->group(function () {
        Route::get('', [SupplierDeliveryController::class, 'index'])->name('supplier-delivery.index');
        Route::post('update', [SupplierDeliveryController::class, 'update'])->name('supplier-delivery.update');
        Route::post('send-mail', [SupplierDeliveryController::class, 'sendMail'])->name('supplier-delivery.send-mail');

    });

});

Route::prefix('guest')->group(function () {
    Route::prefix('supplier-delivery')->group(function () {
        Route::get('{hash}/show', [SupplierDeliveryController::class, 'show'])->name('supplier-delivery.show');
    });
});

