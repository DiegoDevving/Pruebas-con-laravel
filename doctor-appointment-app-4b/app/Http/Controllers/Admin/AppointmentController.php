<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function consult(Appointment $appointment)
    {
        return view('admin.appointments.consult', compact('appointment'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.appointments.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        {
            // Traemos los doctores y pacientes con sus nombres de usuario
            $doctors = Doctor::with('user')->get();
            $patients = Patient::with('user')->get();
            
            return view('admin.appointments.create', compact('doctors', 'patients'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'doctor_id' => 'required|exists:doctors,id',
        'patient_id' => 'required|exists:patients,id',
        'date' => 'required|date|after_or_equal:today',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
        'notes' => 'nullable|string'
    ]);

    Appointment::create($data);

    session()->flash('swal', [
        'icon' => 'success',
        'title' => 'Cita agendada',
        'text' => 'La cita se ha registrado correctamente'
    ]);

    return redirect()->route('admin.appointments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
