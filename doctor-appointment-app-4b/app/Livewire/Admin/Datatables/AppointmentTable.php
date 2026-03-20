<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AppointmentTable extends DataTableComponent
{
    protected $model = Appointment::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Appointment::query()->with(['doctor.user', 'patient.user']);
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")->sortable(),
            
            Column::make("Fecha", "date")->sortable(),
            
            Column::make("Inicio", "start_time"),
            
            Column::make("Fin", "end_time"),
            
            Column::make("Doctor", "doctor.user.name")->searchable(),
            
            Column::make("Paciente", "patient.user.name")->searchable(),

            Column::make("Estado", "status")
                ->format(fn($value) => match($value) {
                    'Scheduled' => '<span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Programada</span>',
                    'Completed' => '<span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Completada</span>',
                    'Cancelled' => '<span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Cancelada</span>',
                    default => $value
                })->html(),

            Column::make("Acciones", "id")
                ->format(fn($value, $row) => view('admin.appointments.actions', ['row' => $row])),
        ];
    }
}
