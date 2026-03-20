<?php

use App\Models\SupportTicket;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

SupportTicket::create([
    'name' => 'Juan Perez',
    'email' => 'juan@example.com',
    'subject' => 'Problema con mi cita',
    'message' => 'No puedo ver mi cita programada para la próxima semana en el sistema.',
    'status' => 'abierto'
]);

SupportTicket::create([
    'name' => 'Maria Gonzalez',
    'email' => 'maria@example.com',
    'subject' => 'Error al pagar',
    'message' => 'El sistema me cobra doble.',
    'status' => 'cerrado'
]);

echo "Tickets created successfully!\n";
