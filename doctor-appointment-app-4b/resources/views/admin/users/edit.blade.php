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
            <div class="space-y-4">
                <div class="grid lg:grid-cols-2 gap-4">

                    <x-wire-input name="name" label="Nombre" required :value="old('name', $user->name)"
                                  placeholder="Nombre" autocomplete="name"/>

                    <x-wire-input name="email" label="Email" required :value="old('email', $user->email)"
                                  placeholder="usuario@email.com" autocomplete="email" inputmode="email"/>

                    {{-- Se agregó type="password" --}}
                    <x-wire-input name="password" label="Contraseña" type="password"
                                  :value="old('password_confirmation')"
                                  placeholder="Mínimo 8 caracteres" autocomplete="new-password"
                                  inputmode="password"/>

                    {{-- Se corrigió lavel por label --}}
                    <x-wire-input name="password_confirmation" label="Confirmar contraseña" type="password"
                                  !value="old('password_confirmation')"
                                  placeholder="Repita la contraseña" autocomplete="new-password"
                                  inputmode="password"/>

                    <x-wire-input name="id_number" label="Número de ID" required :value="old('id_number', $user->id_number)"
                                  placeholder="Ej. 123456789" autocomplete="off" inputmode="numeric" />

                    {{-- Se corrigió la comilla en old('phone') --}}
                    <x-wire-input name="phone" label="Teléfono" required :value="old('phone', $user->phone)"
                                  placeholder="Ej. 123456789" autocomplete="tel" inputmode="tel" />

                </div>

                <x-wire-input name="address" label="Dirección" required :value="old('address', $user->address)"
                              placeholder="Ej. Calle 23" autocomplete="street-address" />

                <div class="space-y-1">
                    {{-- Se corrigió la comilla extra en required --}}
                    <x-wire-native-select name="role_id" label="Rol" required>
                        <option value="">Seleccione un rol</option>
                        {{-- Se cambió $role as $role por $roles as $role --}}
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" @selected(old('role_id', $user->roles->first()->id) == $role->id)>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </x-wire-native-select>

                    <p class="text-sm text-gray-500">
                        Define los permisos y accesos del usuario
                    </p>

                    <div class="flex justify-end">
                        <x-wire-button type="submit">
                            Actualizar
                        </x-wire-button>
                    </div>
                </div>
            </div>
        </form>
    </x-wire-card>

</x-admin-layout>
