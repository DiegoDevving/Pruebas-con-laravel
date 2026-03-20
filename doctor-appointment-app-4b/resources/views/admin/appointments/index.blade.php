<x-admin-layout
    title="Citas | Gatocura"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Citas'],
    ]">

    {{-- Botón de Crear en el Action Slot (Esquina superior derecha) --}}
    <x-slot name="action">
        <x-wire-button primary href="{{ route('admin.appointments.create') }}">
            <i class="fa-solid fa-plus mr-2"></i>
            Nueva Cita
        </x-wire-button>
    </x-slot>

    <div class="mt-4">
        <livewire:admin.datatables.appointment-table />
    </div>
</x-admin-layout>