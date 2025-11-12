<x-admin-layout title="Usuarios | Gatocura" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
    ],
]">

    <x-slot name="action">
        <x-wire-button blue>
            <i class="fa-solid fa-plus"></i>
            Nuevo Usuario
        </x-wire-button>
    </x-slot>
    <!--
    <div class="p-6 bg-white rounded-lg shadow">
        <h1 class="text-2xl font-semibold mb-4">Gestión de Usuarios</h1>

        <p class="text-gray-600">Aquí podrás administrar los usuarios del sistema.</p>
    </div>
    -->
</x-admin-layout>
