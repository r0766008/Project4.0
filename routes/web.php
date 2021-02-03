<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\TruckController as AdminTruckController;
use App\Http\Controllers\Admin\BayController as AdminBayController;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\LogisticsEmployee\TruckController as LogisticsTruckController;
use App\Http\Controllers\LogisticsEmployee\BayController as LogisticsBayController;
use App\Http\Controllers\LogisticsEmployee\ScheduleController as LogisticsScheduleController;

use App\Http\Controllers\User\ScheduleController as UserScheduleController;
use App\Http\Controllers\User\TruckController as UserTruckController;

use App\Http\Controllers\LoadingEmployee\BayController as LoadingBayController;
use App\Http\Controllers\LoadingEmployee\ScheduleController as LoadingScheduleController;

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
Auth::routes(['register' => false]);
Route::view('/', 'home');
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::redirect('/', 'admin/bays');
    Route::resource('bays', AdminBayController::class)->names([
        'index' => 'admin.bays.index',
        'create' => 'admin.bays.create',
        'show' => 'admin.bays.show',
        'edit' => 'admin.bays.edit',
        'store' => 'admin.bays.store',
        'update' => 'admin.bays.update',
        'destroy' => 'admin.bays.destroy'
    ]);
    Route::resource('trucks', AdminTruckController::class)->names([
        'index' => 'admin.trucks.index',
        'create' => 'admin.trucks.create',
        'show' => 'admin.trucks.show',
        'edit' => 'admin.trucks.edit',
        'store' => 'admin.trucks.store',
        'update' => 'admin.trucks.update',
        'destroy' => 'admin.trucks.destroy',
    ]);
    Route::delete('trucks/{truck_id}/drivers/{user_id}', [AdminTruckController::class, 'deleteDriver']);
    Route::post('trucks/{truck_id}/drivers/create', [AdminTruckController::class, 'addDriver']);
    Route::resource('schedules', AdminScheduleController::class)->names([
        'index' => 'admin.schedules.index',
        'create' => 'admin.schedules.create',
        'show' => 'admin.schedules.show',
        'edit' => 'admin.schedules.edit',
        'store' => 'admin.schedules.store',
        'update' => 'admin.schedules.update',
        'destroy' => 'admin.schedules.destroy'
    ]);
    Route::post('schedules/dayschedule/create', [AdminScheduleController::class, 'daySchedule']);
    Route::resource('users', UserController::class);
});
Route::middleware(['auth', 'trucker'])->prefix('user')->group(function () {
    Route::redirect('/', 'user/schedules');
    Route::resource('trucks', UserTruckController::class);
    Route::resource('schedules', UserScheduleController::class);
});
Route::middleware(['auth', 'logisticemployee'])->prefix('logistics')->group(function () {
    Route::redirect('/', 'logistics/bays');
    Route::resource('bays', LogisticsBayController::class)->names([
        'index' => 'logisticsemployee.bays.index',
        'create' => 'logisticsemployee.bays.create',
        'show' => 'logisticsemployee.bays.show',
        'edit' => 'logisticsemployee.bays.edit',
        'store' => 'logisticsemployee.bays.store',
        'update' => 'logisticsemployee.bays.update',
        'destroy' => 'logisticsemployee.bays.destroy'
    ]);
    Route::resource('trucks', LogisticsTruckController::class)->names([
        'index' => 'logisticsemployee.trucks.index',
        'create' => 'logisticsemployee.trucks.create',
        'show' => 'logisticsemployee.trucks.show',
        'edit' => 'logisticsemployee.trucks.edit',
        'store' => 'logisticsemployee.trucks.store',
        'update' => 'logisticsemployee.trucks.update',
        'destroy' => 'logisticsemployee.trucks.destroy'
    ]);
    Route::delete('trucks/{truck_id}/drivers/{user_id}', [LogisticsTruckController::class, 'deleteDriver']);
    Route::post('trucks/{truck_id}/drivers/create', [LogisticsTruckController::class, 'addDriver']);
    Route::resource('schedules', LogisticsScheduleController::class)->names([
        'index' => 'logisticsemployee.schedules.index',
        'create' => 'logisticsemployee.schedules.create',
        'show' => 'logisticsemployee.schedules.show',
        'edit' => 'logisticsemployee.schedules.edit',
        'store' => 'logisticsemployee.schedules.store',
        'update' => 'logisticsemployee.schedules.update',
        'destroy' => 'logisticsemployee.schedules.destroy'
    ]);
    Route::post('schedules/dayschedule/create', [LogisticsScheduleController::class, 'daySchedule']);
});
Route::middleware(['auth', 'loadingemployee'])->prefix('loading')->group(function () {
    Route::redirect('/', 'loading/bays');
    Route::resource('bays', LoadingBayController::class)->names([
        'index' => 'loading.bays.index',
        'create' => 'loading.bays.create',
        'store' => 'loading.bays.store',
        'destroy' => 'loading.bays.destroy'
    ]);
    Route::resource('schedule', LoadingScheduleController::class);
    Route::post('schedule/{schedule_id}/change', [LoadingScheduleController::class, 'changeStatus']);
});

