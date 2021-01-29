<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TruckController as AdminTruckController;
use App\Http\Controllers\Admin\BayController as AdminBayController;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
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
Auth::routes();
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
        'destroy' => 'admin.trucks.destroy'
    ]);
    Route::resource('schedules', AdminScheduleController::class)->names([
        'index' => 'admin.schedules.index',
        'create' => 'admin.schedules.create',
        'show' => 'admin.schedules.show',
        'edit' => 'admin.schedules.edit',
        'store' => 'admin.schedules.store',
        'update' => 'admin.schedules.update',
        'destroy' => 'admin.schedules.destroy'
    ]);
    Route::resource('users', UserController::class);
});
Route::middleware(['auth', 'trucker'])->prefix('user')->group(function () {
    Route::redirect('/', 'user/schedules');
    Route::resource('trucks', UserTruckController::class);
    Route::resource('schedules', UserScheduleController::class);
});
Route::middleware(['auth', 'logisticemployee'])->prefix('logistics')->group(function () {
    Route::redirect('/', 'logistics/bays');
    Route::resource('bays', AdminBayController::class);
    Route::resource('trucks', AdminTruckController::class);
    Route::resource('schedules', AdminScheduleController::class);
});
Route::middleware(['auth', 'loadingemployee'])->prefix('loading')->group(function () {
    Route::redirect('/', 'loading/bays');
    Route::resource('bays', LoadingBayController::class);
    Route::resource('schedule', LoadingScheduleController::class);
});

