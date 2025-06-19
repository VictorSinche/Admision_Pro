<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoPostulanteController;
use App\Http\Controllers\PostulanteLoginController;
use App\Http\Controllers\CreatePostulanteController;
use App\Http\Controllers\DeclaracionJuradaController;
use App\Http\Controllers\PermisoPostulanteController;

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('login.postulante'))->name('auth.login');

Route::get('/login-postulante', [PostulanteLoginController::class, 'form'])->name('login.postulante');
Route::post('/login-postulante', [PostulanteLoginController::class, 'login'])->name('login.postulante.submit');
Route::post('/logout', [PostulanteLoginController::class, 'logout'])->name('logout');

Route::middleware('auth.admin')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Rutas de Permisos
    |--------------------------------------------------------------------------
    */
    Route::get('/usuarios-admin', [PostulanteLoginController::class, 'viewUser'])->name('usuarios');
    Route::get('/listPermisos', [PermisoPostulanteController::class, 'index'])->name('user.listPermisos');
    Route::post('/listPermisos', [PermisoPostulanteController::class, 'update'])->name('user.updatePermisos');
    Route::post('/usuarios-admin/store', [PostulanteLoginController::class, 'createUpdateUser'])->name('usuarios.admin.store');
    /*
    |--------------------------------------------------------------------------
    | Rutas de Administración
    |--------------------------------------------------------------------------
    */
    Route::get('/convalidacion', fn() => view('director.convalidacion'))->name('director.convalidacion');
    Route::get('/historialdj', [InfoPostulanteController::class, 'listarPostulantesConDJ'])->name('admision.historialDj');
    Route::get('/listpostulante', [InfoPostulanteController::class, 'resumenEstados'])->name('admision.listpostulante');
    Route::post('/exceldj', [InfoPostulanteController::class, 'exportarExcelDJ'])->name('exceldj');

    /*
    |--------------------------------------------------------------------------
    | Rutas de Declaración Jurada
    |--------------------------------------------------------------------------
    */
    Route::get('/declaracion-jurada/{modalidad?}', [InfoPostulanteController::class, 'vistaDeclaracionJurada'])->name('declaracionJurada.formulario');
    Route::post('/declaracion-jurada/guardar', [InfoPostulanteController::class, 'guardarDeclaracion'])->name('declaracionJurada.guardar');
    Route::get('/declaracion-jurada/pdf/{dni}', [DeclaracionJuradaController::class, 'descargarDeclaracionJuradaPDF'])->name('declaracionJurada.descargar');

    /*
    |--------------------------------------------------------------------------
    | Rutas de Menús y Submenús
    |--------------------------------------------------------------------------
    */
    Route::get('/coa', fn() => view('coa.listado'))->name('coa.listado');
    // Route::get('/listusers', fn() => view('auth.listyPermisos.listuser'))->name('user.list');
    Route::get('/osar', fn() => view('osar.listado'))->name('osar.listado');
    Route::get('/tesoreria', fn() => view('tesoreria.listado'))->name('tesoreria.listado');

    //se cambioooooo
    Route::get('/validar-responsable', fn() => view('admision.validarDocs.validardocpostulanteresponsable'))->name('admision.responsable');
    Route::get('/validar', fn() => view('admision.validarDocs.validardocpostulantes'))->name('admision.validar');

});

/*
|--------------------------------------------------------------------------
| Rutas del Postulante
|--------------------------------------------------------------------------
*/
Route::middleware('auth.postulante')->group(function () {

    Route::get('/dashboard', fn() => view('dashboard.dashboard'))->name('dashboard.dashboard');
    Route::get('/documentos-json/{dni}', [InfoPostulanteController::class, 'documentosJson']);

    Route::get('/especialidades-por-facultad', [InfoPostulanteController::class, 'getEspecialidades'])->name('especialidades.por.facultad');
    Route::get('/pagosinscripcion', fn() => view('student.pagosinscripcion'))->name('student.pagosinscripcion');
    Route::get('/registro', [InfoPostulanteController::class, 'mostrarFormulario'])->name('student.registro');
    Route::post('/guardaroupdatear', [InfoPostulanteController::class, 'storeOrUpdate']);
    Route::get('/subirdocumentos/{c_numdoc}', [InfoPostulanteController::class, 'vistaDocumentos'])->name('student.subirdocumentos');
    Route::post('/subirdocumentos/{c_numdoc}', [InfoPostulanteController::class, 'guardarDocumentos'])->name('student.guardar.documentos');
    Route::get('/verhorario', fn() => view('student.verhorario'))->name('student.verhorario');
    /*
    |--------------------------------------------------------------------------
    | Rutas de Declaración Jurada
    |--------------------------------------------------------------------------
    */
    Route::get('/declaracion-jurada/{modalidad?}', [InfoPostulanteController::class, 'vistaDeclaracionJurada'])->name('declaracionJurada.formulario');
    Route::post('/declaracion-jurada/guardar', [InfoPostulanteController::class, 'guardarDeclaracion'])->name('declaracionJurada.guardar');
    Route::get('/declaracion-jurada/pdf/{dni}', [DeclaracionJuradaController::class, 'descargarDeclaracionJuradaPDF'])->name('declaracionJurada.descargar');


    /*
    |--------------------------------------------------------------------------
    | Rutas para Libro de reclamciones
    |--------------------------------------------------------------------------
    */

    Route::get('/auth/microsoft', [App\Http\Controllers\Auth\MicrosoftController::class, 'redirectToMicrosoft']);
    Route::get('/callback/microsoft', [App\Http\Controllers\Auth\MicrosoftController::class, 'handleMicrosoftCallback']);
});

/*
|--------------------------------------------------------------------------
| Rutas del Registro SIGU
|--------------------------------------------------------------------------
*/
Route::get('/crear-postulante', [CreatePostulanteController::class, 'mostrarFormulario'])->name('register.registro');
Route::post('/crear-postulante', [CreatePostulanteController::class, 'registrarPostulante']);



