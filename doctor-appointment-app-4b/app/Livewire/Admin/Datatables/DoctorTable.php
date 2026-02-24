<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DoctorTable extends DataTableComponent
{
    protected $model = Doctor::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        // Cargamos las relaciones para que no dé error al buscar el nombre o la especialidad
        return Doctor::query()->with(['user', 'specialty']);
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")->sortable(),

            // Accedemos al nombre del usuario a través de la relación
            Column::make("Nombre", "user.name")
                ->sortable()
                ->searchable(),

            Column::make("Especialidad", "specialty.name")
                ->format(fn($value) => $value ?: 'N/A'),

            // LÓGICA CONDICIONAL: Si no hay dato, muestra N/A
            Column::make("Cédula", "medical_license_number")
                ->format(fn($value) => $value ?: 'N/A'),

            Column::make("Biografía", "biography")
                ->format(fn($value) => $value ? \Illuminate\Support\Str::limit($value, 20) : 'N/A'),

            // Columna para el archivo actions.blade.php que creamos antes
            Column::make("Acciones", "id")
                ->format(fn($value, $row) => view('admin.doctors.actions', ['doctor' => $row])),
        ];
    }
}
