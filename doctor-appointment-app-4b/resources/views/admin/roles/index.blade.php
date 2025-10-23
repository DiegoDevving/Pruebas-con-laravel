<x-admin-layout title="Roles | Gatocura" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'), //Deberia ser admin.dashboard
    ],
    [
        'name' => 'Roles',
    ],
]">
    <livewire:admin.datatables.role-table />
</x-admin-layout>

