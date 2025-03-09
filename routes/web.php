<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    return 'Hello World';
});

Route::get('/hola', function () {
    return 'Hola Mundo';
});


Router::get('/movies', [MovieController::class, 'index']);