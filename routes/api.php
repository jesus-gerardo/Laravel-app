<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Catalogos\NivelesController;
use App\Http\Controllers\Catalogos\MateriasController;
use App\Http\Controllers\Catalogos\ReticulasMateriasController;
use App\Http\Controllers\Catalogos\SalonesController;
use App\Http\Controllers\Alumnos\AlumnosController;
use App\Http\Controllers\Horarios\MateriasHorariosController;

Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('auth/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) { return $request->user();});

    Route::prefix('catalogo')->group(function(){
        Route::resource('nivel', NivelesController::class);
        Route::resource('salones', SalonesController::class);
        Route::resource('materias', MateriasController::class);
        Route::resource('reticula', ReticulasMateriasController::class);
    });

    Route::prefix('materias/horarios')->group(function(){
        Route::get('/{materia_id}', [MateriasHorariosController::class, 'index']);
        Route::get('/dias/{id}', [MateriasHorariosController::class, 'salon_horario']);
        Route::post('/store', [MateriasHorariosController::class, 'store']);

    });

    Route::prefix('alumnos')->group(function(){
        Route::get('/', [AlumnosController::class, 'index']);
        Route::get('/{alumnos}', [AlumnosController::class, 'show']);
        Route::post('/', [AlumnosController::class, 'store']);
        Route::put('/{id}', [AlumnosController::class, 'update']);
    });
});