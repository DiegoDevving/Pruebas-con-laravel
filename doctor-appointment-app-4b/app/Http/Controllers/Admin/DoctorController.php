<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.doctors.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Necesitaremos las especialidades para el select de WireUI
        $specialties = Specialty::all();
        return view('admin.doctors.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $specialties = Specialty::all();
        return view('admin.doctors.edit', compact('doctor', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        // 1. Validar la información
        $request->validate([
            'specialty_id'           => 'required|exists:specialties,id',
            'medical_license_number' => 'nullable|string|max:5',
            'biography'              => 'nullable|string|max:1000',
        ]);

        // 2. Actualizar el modelo Doctor
        $doctor->update([
            'specialty_id'           => $request->specialty_id,
            'medical_license_number' => $request->medical_license_number,
            'biography'              => $request->biography,
        ]);

        // 3. Redireccionar con un mensaje de sesión que capture Swal2
        return redirect()->route('admin.doctors.index')
            ->with('swal', [
                'icon'  => 'success',
                'title' => '¡Logrado!',
                'text'  => 'La información del doctor ha sido actualizada correctamente.',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
