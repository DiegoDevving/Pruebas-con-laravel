<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Redirección inicial al panel de administración
Route::redirect('/', '/admin');

// Middleware de autenticación de Jetstream
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Ruta del dashboard general
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 👉 Grupo de rutas del panel de administración
    Route::prefix('admin')->name('admin.')->group(function () {

        // Dashboard del panel de administración
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // CRUD completo de usuarios
        Route::resource('users', UserController::class);
    });
    });
