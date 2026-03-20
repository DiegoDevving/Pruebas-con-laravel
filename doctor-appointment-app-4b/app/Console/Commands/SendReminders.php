<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = now()->addDay()->format('Y-m-d');
        $appointments = Appointment::where('date', $tomorrow)->get();

        foreach ($appointments as $appointment) {
            // Enviar la misma notificación o una específica de recordatorio
            $appointment->patient->notify(new AppointmentReminder($appointment));
        }
    }
}
