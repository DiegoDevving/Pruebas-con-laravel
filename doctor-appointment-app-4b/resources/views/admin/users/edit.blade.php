<x-admin-layout
    title="Roles | Gatocura"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'), //Deberia ser admin.dashboard
        ],
        [
            'name' => 'Users',
            'href' => route('admin.users.index'),
        ],
        [
            'name' => 'Editar',
        ],
]">
    <x-wire-card>
        <form action="{{ route('admin.users.update', $user) }}" method="POST">

            @csrf

            @method('PUT')

            <x-wire-input label="Nombre" name="name" placeholder="Nombre del usuario" value="{{ old('name', $user->name) }}">


            </x-wire-input>
            <div class="flex justify-end mt-4">
                <x-wire-button type="submit" blue>
                    Actualizar
                </x-wire-button>
            </div>
        </form>
    </x-wire-card>
</x-admin-layout>
