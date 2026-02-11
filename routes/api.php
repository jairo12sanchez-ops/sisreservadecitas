<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas API para testing con Postman.
| Estas rutas devuelven JSON y NO afectan las rutas web existentes.
| Todas las rutas API tienen el prefijo automático /api/
|
*/

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
*/
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:web');

// Ruta de autenticación básica
Route::middleware('auth:web')->get('/user', [App\Http\Controllers\Api\AuthController::class, 'user']);

/*
|--------------------------------------------------------------------------
| Rutas API para Configuraciones
|--------------------------------------------------------------------------
*/
Route::prefix('configuraciones')->middleware('auth:web')->group(function () {
    Route::get('/', [App\Http\Controllers\ConfiguracioneController::class, 'index']);
    Route::post('/', [App\Http\Controllers\ConfiguracioneController::class, 'store']);
    Route::get('/{id}', [App\Http\Controllers\ConfiguracioneController::class, 'show']);
    Route::put('/{id}', [App\Http\Controllers\ConfiguracioneController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\ConfiguracioneController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Rutas API para Usuarios
|--------------------------------------------------------------------------
*/
Route::prefix('usuarios')->middleware('auth:web')->group(function () {
    Route::get('/', [App\Http\Controllers\UsuarioController::class, 'index']);
    Route::post('/', [App\Http\Controllers\UsuarioController::class, 'store']);
    Route::get('/{id}', [App\Http\Controllers\UsuarioController::class, 'show']);
    Route::put('/{id}', [App\Http\Controllers\UsuarioController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Rutas API para Secretarias
|--------------------------------------------------------------------------
*/
Route::prefix('secretarias')->middleware('auth:web')->group(function () {
    Route::get('/', [App\Http\Controllers\SecretariaController::class, 'index']);
    Route::post('/', [App\Http\Controllers\SecretariaController::class, 'store']);
    Route::get('/{id}', [App\Http\Controllers\SecretariaController::class, 'show']);
    Route::put('/{id}', [App\Http\Controllers\SecretariaController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\SecretariaController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Rutas API para Pacientes
|--------------------------------------------------------------------------
*/
Route::prefix('pacientes')->middleware('auth:web')->group(function () {
    Route::get('/', [App\Http\Controllers\PacienteController::class, 'index']);
    Route::post('/', [App\Http\Controllers\PacienteController::class, 'store']);
    Route::get('/buscar/{di}', [App\Http\Controllers\PacienteController::class, 'buscar_por_di']);
    Route::get('/{id}', [App\Http\Controllers\PacienteController::class, 'show']);
    Route::put('/{id}', [App\Http\Controllers\PacienteController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\PacienteController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Rutas API para Consultorios
|--------------------------------------------------------------------------
*/
Route::prefix('consultorios')->middleware('auth:web')->group(function () {
    Route::get('/', [App\Http\Controllers\ConsultorioController::class, 'index']);
    Route::post('/', [App\Http\Controllers\ConsultorioController::class, 'store']);
    Route::get('/{id}', [App\Http\Controllers\ConsultorioController::class, 'show']);
    Route::put('/{id}', [App\Http\Controllers\ConsultorioController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\ConsultorioController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Rutas API para Doctores
|--------------------------------------------------------------------------
*/
Route::prefix('doctores')->middleware('auth:web')->group(function () {
    Route::get('/', [App\Http\Controllers\DoctorController::class, 'index']);
    Route::post('/', [App\Http\Controllers\DoctorController::class, 'store']);
    Route::get('/{id}', [App\Http\Controllers\DoctorController::class, 'show']);
    Route::put('/{id}', [App\Http\Controllers\DoctorController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\DoctorController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Rutas API para Horarios
|--------------------------------------------------------------------------
*/
Route::prefix('horarios')->middleware('auth:web')->group(function () {
    Route::get('/', [App\Http\Controllers\HorarioController::class, 'index']);
    Route::post('/', [App\Http\Controllers\HorarioController::class, 'store']);
    Route::get('/consultorios/{id}', [App\Http\Controllers\HorarioController::class, 'cargar_datos_consultorios']);
    Route::get('/{id}', [App\Http\Controllers\HorarioController::class, 'show']);
    Route::put('/{id}', [App\Http\Controllers\HorarioController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\HorarioController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Rutas API para Eventos/Reservas
|--------------------------------------------------------------------------
*/
Route::prefix('eventos')->middleware('auth:web')->group(function () {
    Route::post('/', [App\Http\Controllers\EventController::class, 'store']);
    Route::delete('/', [App\Http\Controllers\EventController::class, 'destroy']);
});

Route::prefix('reservas')->middleware('auth:web')->group(function () {
    Route::get('/{id}', [App\Http\Controllers\AdminController::class, 'ver_reservas']);
});

/*
|--------------------------------------------------------------------------
| Rutas API para Historial Clínico
|--------------------------------------------------------------------------
*/
Route::prefix('historial')->middleware('auth:web')->group(function () {
    Route::get('/', [App\Http\Controllers\HistorialController::class, 'index']);
    Route::post('/', [App\Http\Controllers\HistorialController::class, 'store']);
    Route::get('/buscar_paciente', [App\Http\Controllers\HistorialController::class, 'buscar_paciente']);
    Route::get('/{id}', [App\Http\Controllers\HistorialController::class, 'show']);
    Route::put('/{id}', [App\Http\Controllers\HistorialController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\HistorialController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Rutas API para Pagos
|--------------------------------------------------------------------------
*/
Route::prefix('pagos')->middleware('auth:web')->group(function () {
    Route::get('/', [App\Http\Controllers\PagoController::class, 'index']);
    Route::post('/', [App\Http\Controllers\PagoController::class, 'store']);
    Route::get('/{id}', [App\Http\Controllers\PagoController::class, 'show']);
    Route::put('/{id}', [App\Http\Controllers\PagoController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\PagoController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Rutas API Públicas (sin autenticación)
|--------------------------------------------------------------------------
*/
Route::get('/consultorios-publicos/{id}', [App\Http\Controllers\WebController::class, 'cargar_datos_consultorios']);
Route::get('/cargar_reserva_doctores/{id}', [App\Http\Controllers\WebController::class, 'cargar_reserva_doctores']);

