<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoPostulanteController;

Route::get('/', function () { return view('auth.login'); }) -> name('auth.login');
Route::get('/dashboard', function () { return view('dashboard.dashboard'); }) -> name('dashboard.dashboard');
Route::get('/registro', [InfoPostulanteController::class, 'mostrarFormulario'])->name('student.registro');

Route::get('/pagosinscripcion', function () { return view('student.pagosinscripcion'); }) -> name('student.pagosinscripcion');
Route::get('/subirdocumentos', function () { return view('student.subirdocument'); }) -> name('student.subirdocumentos');
Route::get('/verhorario', function () { return view('student.verhorario'); }) -> name('student.verhorario');

Route::get('/listpostulante', function () { return view('admision.listapostulantes'); }) -> name('admision.listpostulante');

Route::get('/convalidacion', function () { return view('director.convalidacion'); }) -> name('director.convalidacion');

Route::post('/registrar-postulante', [InfoPostulanteController::class, 'store']);