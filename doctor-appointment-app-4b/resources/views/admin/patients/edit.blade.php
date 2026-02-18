{{-- Logica de php para menjar errores y controlar la pestaa activa --}}
@php
    $errorGroups = [
        'antecedentes' => ['allergies', 'chronic_conditions','surgical_history','family_history'],
        'informacion-general' => ['blood_type_id', 'observations'],
        'contacto-emergencia' => ['emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',
        ],
    ];

    //Pestaña por defecto
    $initialTab = 'datos-personales';

    //Si hay errores, buscamos en que grupo estan para abrir essa pestaña automaticamente
    //$errors se marca como indefinida por el editor pero gracias al middleware esta funciona
    foreach ($errorGroups as $tabName => $fields) {
        if($errors->hasAny($fields)) {
            $initialTab = $tabName;
            break; //Salimos del bucle
        }
    }
@endphp

<x-admin-layout
    title="Pacientes | Gatocura"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Pacientes', 'href' => route('admin.patients.index')],
        ['name' => 'Editar'],
    ]">

    <form action="{{route('admin.patients.update',$patient)}}" method="POST">
        @csrf
        @method('PUT')

        {{-- Encabezado con foto y acciones--}}
        <x-wire-card class="mb-8">
            <div class="lg:flex lg:justify-between lg:items-center">
                <div class="flex items-center">
                    <img src="{{$patient->user->profile_photo_url }}" alt="{{ $patient->user->name}}"
                         class="h-20 w-20 rounded-full object-cover object-center">
                    <div>
                        <p class="text-2xl font-bold text-gray-900 ml-4"> {{ $patient->user->name }}</p>
                    </div>
                </div>
                <div class="flex space-x-3 mt-6 lg:mt-0">
                    <x-wire-button outline gray href="{{ route('admin.patients.index') }}"> Volver </x-wire-button>
                    <x-wire-button type="submit">
                        <i class="fa-solid fa-check"></i>
                        Guardar cambios
                    </x-wire-button>
                </div>
            </div>
        </x-wire-card>

        {{--Tabs de navegacion--}}
        {{-- Tabs de navegación con Componentes Refactorizados --}}
        <x-wire-card>

            <x-tabs :active="$initialTab">

                {{-- SLOT: Header (Botones de navegación) --}}
                <x-slot name="header">
                    {{-- Tab 1: Datos Personales --}}
                    <x-tabs-link name="datos-personales">
                        <i class="fa-solid fa-user me-2"></i> Datos personales
                    </x-tabs-link>

                    {{-- Tab 2: Antecedentes --}}
                    <x-tabs-link name="antecedentes" :error="$errors->hasAny($errorGroups['antecedentes'])">
                        <i class="fa-solid fa-notes-medical me-2"></i> Antecedentes
                    </x-tabs-link>

                    {{-- Tab 3: Información General --}}
                    <x-tabs-link name="informacion-general" :error="$errors->hasAny($errorGroups['informacion-general'])">
                        <i class="fa-solid fa-info me-2"></i> Información general
                    </x-tabs-link>

                    {{-- Tab 4: Contacto Emergencia --}}
                    <x-tabs-link name="contacto-emergencia" :error="$errors->hasAny($errorGroups['contacto-emergencia'])">
                        <i class="fa-solid fa-heart me-2"></i> Contacto de emergencia
                    </x-tabs-link>
                </x-slot>

                {{-- CONTENIDO DE LOS TABS --}}

                {{-- Contenido 1: Datos personales --}}
                <x-tab-content name="datos-personales">
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r-lg shadow-sm">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="fa-solid fa-user-gear text-blue-500 text-xl mt-1"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-bold text-blue-800">Edición de cuenta de usuario</h3>
                                    <div class="mt-1 text-sm text-blue-600">
                                        <p>La <strong>información de acceso</strong> (Nombre, Email y contraseña) debe gestionarse desde la cuenta de usuario asociada.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <x-wire-button primary sm href="{{route('admin.users.edit', $patient->user)}}" target="_blank">
                                    Editar usuario
                                    <i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                                </x-wire-button>
                            </div>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-2 gap-4">
                        <div>
                            <span class="text-gray-500 font-semibold">Teléfono: </span>
                            <span class="text-gray-900 text-sm ml-1">{{ $patient->user->phone }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 font-semibold">Email: </span>
                            <span class="text-gray-900 text-sm ml-1">{{ $patient->user->email }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 font-semibold">Dirección: </span>
                            <span class="text-gray-900 text-sm ml-1">{{ $patient->user->address }}</span>
                        </div>
                    </div>
                </x-tab-content>

                {{-- Contenido 2: Antecedentes --}}
                <x-tab-content name="antecedentes">
                    <div class="grid lg:grid-cols-2 gap-4">
                        <x-wire-textarea label="Alergias conocidas" name="allergies">
                            {{ old('allergies', $patient->allergies) }}
                        </x-wire-textarea>
                        <x-wire-textarea label="Enfermedades crónicas" name="chronic_conditions">
                            {{ old('chronic_conditions', $patient->chronic_conditions) }}
                        </x-wire-textarea>
                        <x-wire-textarea label="Antecedentes quirúrgicos" name="surgical_history">
                            {{ old('surgical_history', $patient->surgical_history) }}
                        </x-wire-textarea>
                        <x-wire-textarea label="Antecedentes familiares" name="family_history">
                            {{ old('family_history', $patient->family_history) }}
                        </x-wire-textarea>
                    </div>
                </x-tab-content>

                {{-- Contenido 3: Información general --}}
                <x-tab-content name="informacion-general">
                    <div class="grid lg:grid-cols-2 gap-4">
                        <x-wire-native-select label="Tipo de sangre" name="blood_type_id">
                            <option value="">Selecciona un tipo de sangre</option>
                            @foreach($bloodTypes as $bloodType)
                                <option value="{{$bloodType->id}}" @selected(old('blood_type_id', $patient->blood_type_id) == $bloodType->id)>
                                    {{ $bloodType->name }}
                                </option>
                            @endforeach
                        </x-wire-native-select>
                        <x-wire-textarea label="Observaciones" name="observations">
                            {{ old('observations', $patient->observations) }}
                        </x-wire-textarea>
                    </div>
                </x-tab-content>

                {{-- Contenido 4: Contacto de emergencia --}}
                <x-tab-content name="contacto-emergencia">
                    <div class="space-y-4">
                        <x-wire-input label="Nombre de contacto" name="emergency_contact_name"
                                      value="{{old('emergency_contact_name', $patient->emergency_contact_name)}}" />

                        <x-wire-phone label="Teléfono de contacto" name="emergency_contact_phone"
                                      mask="(###) ###-####" placeholder="(999) 999-9999"
                                      value="{{old('emergency_contact_phone', $patient->emergency_contact_phone)}}" />

                        <x-wire-input label="Relación con el contacto" name="emergency_contact_relationship" placeholder="Familiar, amigo, etc."
                                      value="{{old('emergency_contact_relationship', $patient->emergency_contact_relationship)}}" />
                    </div>
                </x-tab-content>

            </x-tabs>

        </x-wire-card>
    </form>
</x-admin-layout>
