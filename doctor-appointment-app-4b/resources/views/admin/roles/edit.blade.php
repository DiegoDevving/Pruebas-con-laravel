<x-admin-layout
    title="Roles | Gatocura"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'), //Deberia ser admin.dashboard
        ],
        [
            'name' => 'Roles',
            'href' => route('admin.roles.index'),
        ],
        [
            'name' => 'Editar',
        ],
]">
</x-admin-layout>
