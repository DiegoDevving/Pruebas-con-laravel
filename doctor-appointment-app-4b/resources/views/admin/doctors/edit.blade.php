<x-admin-layout
    title="Doctores | Gatocura"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Doctores', 'href' => route('admin.doctors.index')],
        ['name' => 'Editar'],
    ]">

    <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Encabezado con foto y acciones --}}
        <x-wire-card class="mb-8">
            <div class="lg:flex lg:justify-between lg:items-center">
                <div class="flex items-center">
                    <img src="{{ $doctor->user->profile_photo_url }}" alt="{{ $doctor->user->name }}"
                         class="h-20 w-20 rounded-full border-2 border-blue-500 object-cover object-center">
                    <div>
                        <p class="text-2xl font-bold text-gray-900 ml-4">{{ $doctor->user->name }}</p>
                        {{-- REQUERIMIENTO: Validación Visual N/A --}}
                        <p class="text-sm text-gray-500 ml-4 italic">
                            Licencia: {{ $doctor->medical_license_number ?? 'N/A' }}
                        </p>
                    </div>
                </div>
                <div class="flex space-x-3 mt-6 lg:mt-0">
                    <x-wire-button outline gray href="{{ route('admin.doctors.index') }}"> Volver </x-wire-button>
                    <x-wire-button type="submit" primary>
                        <i class="fa-solid fa-check mr-2"></i>
                        Guardar cambios
                    </x-wire-button>
                </div>
            </div>
        </x-wire-card>

        {{-- Cuerpo del Formulario --}}
        <x-wire-card>
            <div class="grid lg:grid-cols-2 gap-6">

                {{-- Selector de Especialidad --}}
                <x-wire-native-select
                    label="Especialidad Médica"
                    name="specialty_id">
                    <option value="">Selecciona una especialidad</option> {{-- Este enviará el null --}}
                    @foreach($specialties as $specialty)
                        <option value="{{ $specialty->id }}" @selected(old('specialty_id', $doctor->specialty_id) == $specialty->id)>
                            {{ $specialty->name }}
                        </option>
                    @endforeach
                </x-wire-native-select>

                {{-- Número de Licencia Médica --}}
                <x-wire-input
                    label="Número de Licencia Médica"
                    name="medical_license_number"
                    value="{{ old('medical_license_number', $doctor->medical_license_number) }}"
                    placeholder="Ej: 12345678"
                />

                {{-- Biografía (Campo grande) --}}
                <div class="lg:col-span-2">
                    <x-wire-textarea
                        label="Biografía Profesional"
                        name="biography"
                        placeholder="Escriba una breve descripción del perfil del doctor..."
                        rows="4"
                    >{{ old('biography', $doctor->biography) }}</x-wire-textarea>

                    @if(!$doctor->biography)
                        <p class="mt-1 text-xs text-orange-500 font-medium">Estado actual: N/A (Pendiente de captura)</p>
                    @endif
                </div>
            </div>
        </x-wire-card>
    </form>
</x-admin-layout>
