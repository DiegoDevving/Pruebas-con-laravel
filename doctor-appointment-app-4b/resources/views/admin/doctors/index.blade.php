<x-admin-layout
    title="Doctores | Gatocura"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Doctores',
        ],
    ]"
>
    <div class="mb-4 flex justify-end">
        <x-wire-button href="{{ route('admin.doctors.create') }}" primary label="Nuevo Doctor" icon="plus" />
    </div>

    <livewire:admin.datatables.doctor-table />
</x-admin-layout>
