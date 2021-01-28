<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\TruckController;
use App\Http\Controllers\Apis\BayStatusController;
use App\Http\Controllers\Apis\BayController;
use App\Http\Controllers\Apis\ScheduleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('trucks', [TruckController::class, 'index']);
Route::get('truck/arrival/{info}', [TruckController::class, 'registerTruckArrival']);
Route::get('truck/departure/{info}', [TruckController::class, 'registerTruckDeparture']);
Route::post('trucks', [TruckController::class, 'store']);
Route::put('trucks/{truck}', [TruckController::class, 'update']);
Route::delete('trucks/{truck}', [TruckController::class, 'delete']);

Route::get('bays', [BayController::class, 'index']);
Route::post('bays', [BayController::class, 'store']);
Route::put('bays/{bay}', [BayController::class, 'update']);
Route::delete('bays/{bay}', [BayController::class, 'delete']);

Route::get('schedules', [ScheduleController::class, 'index']);
Route::post('schedules', [ScheduleController::class, 'store']);
Route::put('schedules/{schedule}', [ScheduleController::class, 'update']);
Route::delete('schedules/{schedule}', [ScheduleController::class, 'delete']);
