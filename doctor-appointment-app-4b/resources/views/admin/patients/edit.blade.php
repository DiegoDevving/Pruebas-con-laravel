<x-admin-layout
    title="Pacientes | Gatocura"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Pacientes',
            'href' => route('admin.patients.edit'),
        ],
        [
            'name' => 'Editar',
        ],
    ]"
>
</x-admin-layout>
