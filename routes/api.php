<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\ApiV1\Modules\Addresses\Controllers\AddressesController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/addresses', [AddressesController::class, 'create']);

Route::patch('/addresses/{id}', [AddressesController::class, 'patch']);

Route::put('/addresses/{id}', [AddressesController::class, 'replace']);

Route::delete('/addresses/{id}', [AddressesController::class, 'delete']);

Route::get('/addresses/{id}', [AddressesController::class, 'get']);
