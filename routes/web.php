<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', function () {
    return 'Hola Mundo';
});

Route::get('/movies/create', function () {
    return view('movies.create');
});