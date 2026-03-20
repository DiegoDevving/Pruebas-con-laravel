<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class AppointmentConfirmed extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return []; // Mantenemos vacío para evitar el error de "Driver [twilio] not supported"
    }

    public function sendWhatsapp($notifiable)
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $from = env('TWILIO_WHATSAPP_FROM');

        // Forzamos a obtener el teléfono del objeto que recibimos (User)
        $rawPhone = $notifiable->phone ?? $notifiable->telefono;

        // DEPURACIÓN: Si el teléfono sigue vacío, regístralo en el log para saberlo
        if (!$rawPhone) {
            \Log::error("El usuario con ID {$notifiable->id} no tiene teléfono asignado.");
            return false;
        }

        $cleanPhone = preg_replace('/[^0-9]/', '', $rawPhone);
        if (strlen($cleanPhone) === 10) {
            $cleanPhone = '52' . $cleanPhone; 
        }

        $formattedPhone = "whatsapp:+" . $cleanPhone;

        try {
            $twilio = new Client($sid, $token);
            $message = $twilio->messages->create(
                $formattedPhone,
                [
                    "from" => $from,
                    "body" => "Hola {$this->appointment->patient->user->name}, tu cita en Gatocura ha sido confirmada."
                ]
            );
            \Log::info("WhatsApp enviado con éxito: " . $message->sid);
            return $message;
        } catch (\Exception $e) {
            \Log::error("Error de Twilio: " . $e->getMessage());
            return false;
        }
    }
}