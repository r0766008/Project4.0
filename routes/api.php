<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\BayStatusController;
use App\Http\Controllers\BayController;

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
Route::post('trucks', [TruckController::class, 'store']);
Route::put('trucks/{truck}', [TruckController::class, 'update']);
Route::delete('trucks/{truck}', [TruckController::class, 'delete']);

Route::get('baystatuses', [BayStatusController::class, 'index']);
Route::post('baystatuses', [BayStatusController::class, 'store']);
Route::put('baystatuses/{baystatus}', [BayStatusController::class, 'update']);
Route::delete('baystatuses/{baystatus}', [BayStatusController::class, 'delete']);

Route::get('bays', [BayController::class, 'index']);
Route::post('bays', [BayController::class, 'store']);
Route::put('bays/{bay}', [BayController::class, 'update']);
Route::delete('bays/{bay}', [BayController::class, 'delete']);

Route::get('schedules', [BayController::class, 'index']);
Route::post('schedules', [BayController::class, 'store']);
Route::put('schedules/{schedule}', [BayController::class, 'update']);
Route::delete('schedules/{schedule}', [BayController::class, 'delete']);
