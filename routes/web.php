<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TruckController;
use App\Http\Controllers\Admin\BayController;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\User\ScheduleController as UserScheduleController;

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
    Route::resource('bays', BayController::class);
    Route::resource('trucks', TruckController::class);
    Route::resource('schedules', AdminScheduleController::class);
});
Route::middleware(['auth', 'trucker'])->prefix('user')->group(function () {
    Route::redirect('/', 'user/schedules');
    Route::resource('schedules', UserScheduleController::class);
});
Route::middleware(['auth', 'logisticemployee'])->prefix('logistics')->group(function () {
    Route::redirect('/', 'logistics/bays');
    Route::resource('bays', UserScheduleController::class);
});

