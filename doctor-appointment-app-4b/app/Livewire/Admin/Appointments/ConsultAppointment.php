<?php

namespace App\Livewire\Admin\Appointments;

use App\Models\Appointment;
use Livewire\Component;

class ConsultAppointment extends Component
{
    public Appointment $appointment;
    
    // Tabs state
    public $tab = 'consulta';
    
    // Consulta state
    public $diagnosis = '';
    public $treatment = '';
    public $notes = '';
    
    // Receta state
    public $medications = [];

    public function mount(Appointment $appointment)
    {
        $this->appointment = $appointment->load('patient.bloodType'); // Asegurarnos de cargar el tipo de sangre
        $this->loadPreviousAppointments();
    }
    
    // Modals state
    public $showHistoryModal = false;
    public $showPreviousModal = false;
    
    // Data
    public $previousAppointments = [];

    public function loadPreviousAppointments()
    {
        // Traemos las citas anteriores del paciente (excluyendo la actual, y que ya pasaron o están completadas)
        $this->previousAppointments = Appointment::where('patient_id', $this->appointment->patient_id)
            ->where('id', '!=', $this->appointment->id)
            ->where(function($query) {
                $query->where('status', 'Completed')
                      ->orWhere('date', '<', $this->appointment->date);
            })
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();
    }
    
    public function openHistoryModal()
    {
        $this->showHistoryModal = true;
    }
    
    public function openPreviousModal()
    {
        $this->showPreviousModal = true;
    }
    
    public function setTab($tabName)
    {
        $this->tab = $tabName;
    }

    public function addMedication()
    {
        $this->medications[] = [
            'name' => '',
            'dose' => '',
            'frequency' => ''
        ];
    }

    public function removeMedication($index)
    {
        unset($this->medications[$index]);
        $this->medications = array_values($this->medications); // Reindexar el array
    }

    public function save()
    {
        // $this->validate([
        //     'diagnosis' => 'required',
        //     'treatment' => 'required',
        // ]);

        // Aquí iría la lógica de guardado en la Base de Datos
        // $this->appointment->update([
        //     'diagnosis' => $this->diagnosis,
        //     ...
        // ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Consulta Guardada',
            'text' => 'Los datos de la consulta se han guardado exitosamente.'
        ]);
        
        return redirect()->route('admin.appointments.index');
    }

    public function render()
    {
        return view('livewire.admin.appointments.consult-appointment');
    }
}
