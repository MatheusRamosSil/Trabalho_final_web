<?php

use Illuminate\Http\Request;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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
Route::post('/register', [AuthController::class, 'register']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/paciente', [PacienteController::class,'store']);
    Route::get('/paciente/{id}', [PacienteController::class, 'show']);
    Route::get('/paciente', [PacienteController::class, 'index']);
    Route::put('/paciente/{id}', [PacienteController::class, 'update']);
    Route::delete('/paciente/{id}', [PacienteController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
