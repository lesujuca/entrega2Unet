<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\cancionController;
use App\Http\Controllers\Api\ProyectoController;
use App\Http\Controllers\Api\ProyectoListController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Middleware\JwtMiddleware;

//Rutas para albums
Route::get('/albums', [AlbumController::class, 'index']);
Route::get('/albums/{id}', [AlbumController::class, 'show']);
Route::post('/albums', [AlbumController::class, 'store']);
Route::put('/albums/{id}', [AlbumController::class, 'update']);
Route::delete('/albums/{id}', [AlbumController::class, 'delete']);
Route::apiResource('albums', AlbumController::class); // esta linea significa que la url /albums se va a encargar de todos los metodos

//Rutas para canciones
Route::get('albums/{id}/canciones', [cancionController::class, 'getCanciones']);
Route::post('albums/{id}/canciones', [cancionController::class, 'addCancion']);
Route::put('albums/{albumId}/canciones/{cancionId}', [cancionController::class, 'updateCancion']);
Route::delete('albums/{albumId}/canciones/{cancionId}', [cancionController::class, 'deleteCancion']);

//Rutas para proyectos
Route::get('/proyectosList', [ProyectoListController::class, 'index']);
Route::apiResource('proyectosList', ProyectoController::class);

//Rutas para el Login
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
//Rutas para usuarios
Route::group(['middleware' => JwtMiddleware::class], function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{user}', [UserController::class, 'update']);

    Route::get('/proyectos/{id}', [ProyectoController::class, 'show']);
    Route::post('/proyectos', [ProyectoController::class, 'store']);
    Route::put('/proyectos/{id}', [ProyectoController::class, 'update']);
    Route::delete('/proyectos/{id}', [ProyectoController::class, 'delete']);
    Route::apiResource('proyectos', ProyectoController::class);
});
