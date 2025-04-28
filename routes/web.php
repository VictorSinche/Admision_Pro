<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('auth.login'); }) -> name('auth.login');
Route::get('/dashboard', function () { return view('dashboard.dashboard'); }) -> name('dashboard.dashboard');
Route::get('/registro', function () { return view('student.registro'); }) -> name('student.registro');
