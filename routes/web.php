<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cruds\TruckController;
use App\Http\Controllers\Cruds\BayController;
use App\Http\Controllers\Cruds\ScheduleController;

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
Route::middleware(['auth'])->group(function () {
    Route::resource('bays', BayController::class);
    Route::resource('trucks', TruckController::class);
});

