<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    return 'Hello World';
});

Route::get('/hola', function () {
    return 'Hola Mundo';
});

// Ruta para obtener todas las películas
Route::get('/movies', [MovieController::class, 'index']);

// Ruta para obtener una película por su ID
Route::get('/movies/{id}', [MovieController::class, 'show']);

// Ruta para crear una nueva película
Route::post('/movies', [MovieController::class, 'store']);

// Ruta para actualizar una película
Route::put('/movies/{id}', [MovieController::class, 'update']);

// Ruta para eliminar una película
Route::delete('/movies/{id}', [MovieController::class, 'destroy']);
