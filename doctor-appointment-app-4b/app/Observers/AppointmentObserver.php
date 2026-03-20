<?php

namespace App\Observers;

use App\Models\Appointment; // <-- ¡ESTA ES LA LÍNEA QUE FALTA!
use App\Notifications\AppointmentConfirmed;

class AppointmentObserver
{
    /**
     * Handle the Appointment "created" event.
     */
    public function created(Appointment $appointment)
    {
        $notification = new AppointmentConfirmed($appointment);
        
        // CAMBIO CLAVE: Enviamos al usuario (que tiene el phone), no al paciente
        $notification->sendWhatsapp($appointment->patient->user);
    }

    /**
     * Handle the Appointment "updated" event.
     */
    public function updated(Appointment $appointment): void
    {
        //
    }

    /**
     * Handle the Appointment "deleted" event.
     */
    public function deleted(Appointment $appointment): void
    {
        //
    }

    /**
     * Handle the Appointment "restored" event.
     */
    public function restored(Appointment $appointment): void
    {
        //
    }

    /**
     * Handle the Appointment "force deleted" event.
     */
    public function forceDeleted(Appointment $appointment): void
    {
        //
    }
}
