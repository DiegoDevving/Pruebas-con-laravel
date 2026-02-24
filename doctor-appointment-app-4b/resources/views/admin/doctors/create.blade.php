<x-admin-layout
    title="Doctores | Gatocura"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Doctores',
            'href' => route('admin.doctors.index'),
        ],
        [
            'name' => 'Nuevo',
        ],
    ]"
>
    {{-- Aquí irá el formulario de creación más adelante --}}
</x-admin-layout>
