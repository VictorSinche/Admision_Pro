<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoPostulanteController;
use App\Http\Controllers\PostulanteLoginController;
use App\Http\Controllers\CreatePostulanteController;
use App\Http\Controllers\DeclaracionJuradaController;
use App\Models\InfoPostulante;

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('login.postulante'))->name('auth.login');

Route::get('/login-postulante', [PostulanteLoginController::class, 'form'])->name('login.postulante');
Route::post('/login-postulante', [PostulanteLoginController::class, 'login'])->name('login.postulante.submit');

/*
|--------------------------------------------------------------------------
| Rutas del registro sigu
|--------------------------------------------------------------------------
*/
Route::get('/crear-postulante', [CreatePostulanteController::class, 'mostrarFormulario'])->name('register.registro');
Route::post('/crear-postulante', [CreatePostulanteController::class, 'registrarPostulante']);

/*
|--------------------------------------------------------------------------
| Rutas del Postulante
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', fn() => view('dashboard.dashboard'))->name('dashboard.dashboard');

Route::get('/registro', [InfoPostulanteController::class, 'mostrarFormulario'])->name('student.registro');
// Route::post('/registrar-postulante', [InfoPostulanteController::class, 'store']);
Route::post('/guardaroupdatear', [InfoPostulanteController::class, 'storeOrUpdate']);

Route::get('/subirdocumentos/{c_numdoc}', [InfoPostulanteController::class, 'vistaDocumentos'])->name('student.subirdocumentos');
Route::post('/subirdocumentos/{c_numdoc}', [InfoPostulanteController::class, 'guardarDocumentos'])->name('student.guardar.documentos');

Route::get('/pagosinscripcion', fn() => view('student.pagosinscripcion'))->name('student.pagosinscripcion');
Route::get('/verhorario', fn() => view('student.verhorario'))->name('student.verhorario');

Route::get('/especialidades-por-facultad', [InfoPostulanteController::class, 'getEspecialidades'])->name('especialidades.por.facultad');

/*
|--------------------------------------------------------------------------
| Rutas de Administración
|--------------------------------------------------------------------------
*/
Route::get('/listpostulante', fn() => view('admision.listapostulantes'))->name('admision.listpostulante');
Route::get('/convalidacion', fn() => view('director.convalidacion'))->name('director.convalidacion');


/*
|--------------------------------------------------------------------------
| Rutas de Declaración Jurada
|--------------------------------------------------------------------------
*/
Route::get('/declaracion-jurada/{modalidad?}', [InfoPostulanteController::class, 'vistaDeclaracionJurada'])->name('declaracionJurada.formulario');
Route::post('/declaracion-jurada/guardar', [InfoPostulanteController::class, 'guardarDeclaracion'])->name('declaracionJurada.guardar');

Route::get('/declaracion-jurada/pdf', [InfoPostulanteController::class, 'descargarDeclaracionPDF'])->name('declaracion.pdf');
