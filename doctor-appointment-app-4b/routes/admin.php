<?php

use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

//Linea adicional para ver si se arreglan mis rutas que no tienen .admin

Route::get('/', function(){
    return view('admin.dashboard') ;
})->name('dashboard'); //Modificado para arreglar las rutas admin, notas personales diego

//Gestion de roles
Route::resource('roles', RoleController::class);

//Gestion de pacientes
Route::resource('patients', \App\Http\Controllers\Admin\PatientController::class);

