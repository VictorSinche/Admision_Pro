<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoPostulanteController;
use App\Http\Controllers\PostulanteLoginController;
use App\Http\Controllers\CreatePostulanteController;
use App\Http\Controllers\DeclaracionJuradaController;
use App\Http\Controllers\PermisoPostulanteController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EncargadoController;
use App\Http\Controllers\PeticionesController;

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
    | Rutas de dashboard-admin
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'getKPIs'])->name('dashboard.dashboard');
    Route::get('/api/dashboard-data', [DashboardController::class, 'obtenerDatosGraficos']);
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
    // Route::post('/exceldj', [InfoPostulanteController::class, 'exportarExcelDJ'])->name('exceldj');
    Route::post('/exportar-declaracion-jurada', [InfoPostulanteController::class, 'exportExcelMultiple'])
    ->name('exceldj');
    Route::get('/admision/postulantes/verificar', [InfoPostulanteController::class, 'listarPostulantes'])->name('admision.verificar');

    Route::post('/validar-documento', [InfoPostulanteController::class, 'validarCampo'])->name('verificacion.campo');

    Route::get('/encargado/buscar-postulante', [EncargadoController::class, 'formularioBusqueda'])->name('admision.buscar');
    Route::get('/encargado/revisar-documentos', [EncargadoController::class, 'revisarDocumentos'])->name('encargado.revisar');
    
    Route::put('/encargado/postulante/{id}/bloquear/{campo}', [EncargadoController::class, 'toggleBloqueo'])->name('documentos.bloqueo.toggle');
    Route::get('/reportes', fn() => view('admision.reportes.reportes'))->name('admision.reportes');
    //reportes
    Route::get('/exportar-reporte-general', [InfoPostulanteController::class, 'exportarReporteGeneral'])->name('reporte.general');
    Route::get('/reporte-faltantes-detalle', [InfoPostulanteController::class, 'exportarDocumentosFaltantesDetalle'])->name('reporte.faltantes.detalle');
    Route::get('/reporte/sin-declaracion', [InfoPostulanteController::class, 'exportarSinDeclaracion'])->name('reporte.sin_declaracion');
    Route::get('/reporte/evolucion-registros-excel', [InfoPostulanteController::class, 'exportarEvolucion'])->name('reporte.evolucion');

    /*
    |--------------------------------------------------------------------------
    | Rutas de Declaración Jurada
    |--------------------------------------------------------------------------
    */
    // Route::get('/declaracion-jurada/{modalidad?}', [InfoPostulanteController::class, 'vistaDeclaracionJurada'])->name('declaracionJurada.formulario');
    // Route::post('/declaracion-jurada/guardar', [InfoPostulanteController::class, 'guardarDeclaracion'])->name('declaracionJurada.guardar');
    // Route::get('/declaracion-jurada/pdf/{dni}', [DeclaracionJuradaController::class, 'descargarDeclaracionJuradaPDF'])->name('declaracionJurada.descargar');

    /*
    |--------------------------------------------------------------------------
    | Rutas de Menús y Submenús
    |--------------------------------------------------------------------------
    */
    Route::get('/coa', fn() => view('coa.listado'))->name('coa.listado');
    Route::get('/osar', fn() => view('osar.listado'))->name('osar.listado');
    Route::get('/tesoreria', fn() => view('tesoreria.listado'))->name('tesoreria.listado');

    // Route::get('/peti-admin', fn() => view('Peticiones.peticonesadmin'))->name('peticiones.admin');

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

    Route::get('/dashboard-postulante', [DashboardController::class, 'resumenEstados'])->name('dashboardPost.dashboard');

    Route::get('/documentos-json/{dni}', [InfoPostulanteController::class, 'documentosJson']);

    Route::get('/especialidades-por-facultad', [InfoPostulanteController::class, 'getEspecialidades'])->name('especialidades.por.facultad');
    Route::get('/pagosinscripcion', fn() => view('student.pagosinscripcion'))->name('student.pagosinscripcion');
    Route::get('/registro', [InfoPostulanteController::class, 'mostrarFormulario'])->name('student.registro');
    Route::post('/guardaroupdatear', [InfoPostulanteController::class, 'storeOrUpdate']);
    Route::get('/subirdocumentos/{c_numdoc}', [InfoPostulanteController::class, 'vistaDocumentos'])->name('student.subirdocumentos');
    Route::post('/subirdocumentos/{c_numdoc}', [InfoPostulanteController::class, 'guardarDocumentos'])->name('student.guardar.documentos');

    /*
    |--------------------------------------------------------------------------
    | Rutas de Declaración Jurada postulante
    |--------------------------------------------------------------------------
    */
    Route::get('/declaracion-jurada/{modalidad?}', [InfoPostulanteController::class, 'vistaDeclaracionJurada'])->name('declaracionJurada.formulario');
    Route::post('/declaracion-jurada/guardar', [InfoPostulanteController::class, 'guardarDeclaracion'])->name('declaracionJurada.guardar');
    Route::get('/declaracion-jurada/pdf/{dni}', [DeclaracionJuradaController::class, 'descargarDeclaracionJuradaPDF'])->name('declaracionJurada.descargar');
    /*
    |--------------------------------------------------------------------------
    | Rutas de notificaciones
    |--------------------------------------------------------------------------
    */
    Route::post('/notificar-rechazo-documentos', [NotificacionController::class, 'rechazoDocumentos']);
    Route::post('/notificaciones/reset', [NotificacionController::class, 'resetNotificacion'])->name('notificaciones.reset');
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
Route::post('/crear-postulante', [CreatePostulanteController::class, 'registrarPostulante'])->name('postulante.store');



