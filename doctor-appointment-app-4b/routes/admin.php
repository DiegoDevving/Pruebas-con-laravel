<?php

use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SupportTicketController;
use Illuminate\Support\Facades\Route;

//Additional route to fix admin routes

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard'); //Modifie to fix personal routes

//Role management
Route::resource('roles', RoleController::class);

//Patient management
Route::resource('patients', \App\Http\Controllers\Admin\PatientController::class);

//Doctor management
Route::resource('doctors', DoctorController::class);

// Support ticket management
Route::resource('support-tickets', SupportTicketController::class)->except(['create', 'store', 'edit', 'update']);

//Appointment management
Route::get('appointments/{appointment}/consult', [\App\Http\Controllers\Admin\AppointmentController::class, 'consult'])->name('appointments.consult');
Route::resource('appointments', \App\Http\Controllers\Admin\AppointmentController::class);