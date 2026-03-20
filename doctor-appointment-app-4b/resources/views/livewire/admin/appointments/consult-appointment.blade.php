<div x-data="{ openHistory: false, openPrevious: false }">
    {{-- Encabezado de la Consulta Médica --}}
    <x-wire-card class="mb-8">
        <div class="lg:flex lg:justify-between lg:items-center">
            <div class="flex items-center">
                <div class="h-20 w-20 rounded-full border-2 border-blue-500 bg-blue-100 flex items-center justify-center text-blue-600 text-4xl shadow-sm">
                    <i class="fa-solid fa-notes-medical"></i>
                </div>
                <div class="ml-5">
                    <p class="text-2xl font-bold text-gray-900">Consulta Médica</p>
                    <p class="text-sm text-gray-500 mt-1">
                        <span class="font-medium text-gray-700"><i class="fa-regular fa-user mr-1"></i> Paciente:</span> {{ $appointment->patient->user->name }}
                        <span class="mx-2 text-gray-300">|</span>
                        <span class="font-medium text-gray-700"><i class="fa-regular fa-calendar mr-1"></i> Fecha:</span> {{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}
                    </p>
                </div>
            </div>
            <div class="flex space-x-3 mt-6 lg:mt-0">
                <x-wire-button outline gray @click="openHistory = true">
                    <i class="fa-solid fa-clock-rotate-left mr-2"></i> Ver historia 
                </x-wire-button>
                <x-wire-button outline primary @click="openPrevious = true">
                    <i class="fa-solid fa-clipboard-list mr-2"></i> Consultas anteriores
                </x-wire-button>
            </div>
        </div>
    </x-wire-card>

    {{-- Cuerpo de la Consulta --}}
    <x-wire-card>
        <div class="border-b border-gray-200 mb-6">
            <nav class="-mb-px flex space-x-8">
                <button wire:click="setTab('consulta')"
                    class="{{ $tab === 'consulta' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:border-gray-300' }} inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                    <i class="fa-solid fa-stethoscope mr-2"></i> Consulta
                </button>
                <button wire:click="setTab('receta')"
                    class="{{ $tab === 'receta' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:border-gray-300' }} inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                    <i class="fa-solid fa-prescription-bottle-medical mr-2"></i> Receta
                </button>
            </nav>
        </div>

        <form wire:submit.prevent="save">
            @if($tab === 'consulta')
                <div class="space-y-6">
                    <x-wire-textarea label="Diagnóstico" wire:model="diagnosis" placeholder="Escriba el diagnóstico..." rows="4" />
                    <x-wire-textarea label="Tratamiento" wire:model="treatment" placeholder="Plan de tratamiento..." rows="4" />
                    {{-- SECCIÓN DE NOTAS RECUPERADA --}}
                    <x-wire-textarea label="Notas Adicionales" wire:model="notes" placeholder="Observaciones privadas o notas extra..." rows="3" />
                </div>
            @endif

            @if($tab === 'receta')
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-900">Medicamentos</h3>
                        <x-wire-button primary sm icon="plus" wire:click="addMedication">Añadir</x-wire-button>
                    </div>
                    @include('livewire.admin.medical-consultation.partials.medications-table')
                </div>
            @endif

            <div class="mt-8 pt-5 border-t border-gray-200 flex items-center justify-end space-x-3">
                <x-wire-button gray outline href="{{ route('admin.appointments.index') }}">Cancelar</x-wire-button>
                <x-wire-button type="submit" blue icon="check">Guardar Consulta</x-wire-button>
            </div>
        </form>
    </x-wire-card>

    {{-- POP-UPS (HISTORIA Y ANTERIORES) --}}
<template x-if="true">
    <div class="fixed inset-0 z-50 overflow-y-auto" 
         x-show="openHistory || openPrevious" 
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" @click="openHistory = false; openPrevious = false"></div>

        <div class="flex items-center justify-center min-h-screen p-4">
            
            {{-- Contenido del Pop-up: HISTORIA MÉDICA --}}
            <div x-show="openHistory" 
                 class="relative bg-white rounded-xl shadow-2xl max-w-lg w-full overflow-hidden"
                 @click.away="openHistory = false">
                <div class="bg-blue-600 p-4 text-white flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fa-solid fa-id-card-clip mr-2"></i>
                        <h3 class="font-bold">Historia Médica</h3>
                    </div>
                    <button @click="openHistory = false" class="hover:text-blue-200 transition-colors">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                
                <div class="p-6 space-y-4 text-gray-700">
                    {{-- ENLACE SOLICITADO: EDITAR/VER HISTORIAL --}}
                    <div class="flex justify-end mb-2">
                        <a href="{{ route('admin.patients.edit', $appointment->patient->id) }}" 
                           target="_blank" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-bold bg-blue-50 px-3 py-1.5 rounded-md transition-all border border-blue-100 shadow-sm">
                            <i class="fa-solid fa-external-link-alt mr-2"></i>
                            Editar/Ver historia médica
                        </a>
                    </div>

                    <div class="grid grid-cols-2 gap-4 border-b pb-4">
                        <div>
                            <span class="text-xs uppercase text-gray-400 font-bold block">Tipo de Sangre</span>
                            <span class="font-semibold text-gray-900">{{ $appointment->patient->bloodType->name ?? 'No registrado' }}</span>
                        </div>
                        <div>
                            <span class="text-xs uppercase text-gray-400 font-bold block">Última Actualización</span>
                            <span class="text-sm italic text-gray-500">Reciente</span>
                        </div>
                    </div>

                    <div>
                        <span class="text-xs uppercase text-gray-400 font-bold block mb-1">Alergias Conocidas</span>
                        <div class="p-2 bg-red-50 border border-red-100 rounded text-red-700 text-sm">
                            <i class="fa-solid fa-triangle-exclamation mr-1"></i>
                            {{ $appointment->patient->allergies ?: 'Ninguna registrada' }}
                        </div>
                    </div>

                    <div>
                        <span class="text-xs uppercase text-gray-400 font-bold block mb-1">Condiciones Crónicas</span>
                        <p class="text-sm p-2 bg-gray-50 border border-gray-100 rounded">
                            {{ $appointment->patient->chronic_conditions ?: 'Sin registro de condiciones crónicas.' }}
                        </p>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-3 flex justify-end border-t">
                    <button @click="openHistory = false" class="text-gray-500 hover:text-gray-700 font-medium text-sm">Cerrar ventana</button>
                </div>
            </div>

            {{-- Contenido del Pop-up: CONSULTAS ANTERIORES --}}
<div x-show="openPrevious" 
     class="relative bg-white rounded-xl shadow-2xl max-w-3xl w-full overflow-hidden"
     @click.away="openPrevious = false">
    
    {{-- Cabecera del Pop-up --}}
    <div class="bg-indigo-600 p-4 text-white flex justify-between items-center">
        <div class="flex items-center">
            <i class="fa-solid fa-history mr-2"></i>
            <h3 class="font-bold">Historial Detallado de Consultas</h3>
        </div>
        <button @click="openPrevious = false" class="hover:text-indigo-200 transition-colors">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
    </div>

    {{-- Cuerpo con Scroll --}}
    <div class="p-6 max-h-[70vh] overflow-y-auto bg-gray-50 space-y-6">
        @forelse($previousAppointments as $prev)
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden hover:border-indigo-400 transition-all">
                
                {{-- Encabezado de la Tarjeta de Consulta --}}
                <div class="bg-indigo-50 px-4 py-3 border-b border-indigo-100 flex justify-between items-center">
                    <div class="flex flex-col">
                        <span class="text-indigo-700 font-bold text-sm">
                            <i class="fa-regular fa-calendar mr-1"></i> {{ \Carbon\Carbon::parse($prev->date)->format('d/m/Y') }}
                        </span>
                        <span class="text-gray-500 text-xs font-medium">
                            <i class="fa-regular fa-clock mr-1"></i> Horario: {{ $prev->start_time ?? 'N/A' }}
                        </span>
                    </div>
                    <a href="{{ route('admin.appointments.consult', $prev->id) }}" 
                       target="_blank" 
                       class="inline-flex items-center text-xs font-bold bg-white text-indigo-600 px-3 py-1.5 rounded-lg border border-indigo-200 hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                        <i class="fa-solid fa-eye mr-1"></i> Ver detalles
                    </a>
                </div>

                {{-- Detalles de la Consulta --}}
                <div class="p-4 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="text-[10px] uppercase text-gray-400 font-bold block mb-1">Atendido por</span>
                            <div class="flex items-center text-sm text-gray-700">
                                <i class="fa-solid fa-user-md mr-2 text-indigo-400"></i>
                                <span class="font-medium">Dr. {{ $prev->doctor->user->name ?? 'Médico no asignado' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <span class="text-[10px] uppercase text-gray-400 font-bold block mb-1">Diagnóstico</span>
                            <p class="text-sm text-gray-800 bg-gray-50 p-2 rounded border border-gray-100 italic">
                                {{ $prev->diagnosis ?: 'Sin registro de diagnóstico.' }}
                            </p>
                        </div>

                        <div>
                            <span class="text-[10px] uppercase text-gray-400 font-bold block mb-1">Tratamiento</span>
                            <p class="text-sm text-gray-800 bg-blue-50/30 p-2 rounded border border-blue-100/50">
                                {{ $prev->treatment ?: 'Sin registro de tratamiento.' }}
                            </p>
                        </div>

                        @if($prev->notes)
                        <div>
                            <span class="text-[10px] uppercase text-gray-400 font-bold block mb-1">Notas Administrativas</span>
                            <p class="text-sm text-gray-600 bg-amber-50/30 p-2 rounded border border-amber-100/50">
                                {{ $prev->notes }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <i class="fa-solid fa-folder-open text-gray-200 text-6xl mb-4"></i>
                <p class="text-gray-500 font-medium">No existen consultas previas registradas.</p>
            </div>
        @endforelse
    </div>

    {{-- Pie del Pop-up --}}
    <div class="bg-gray-100 px-6 py-3 flex justify-end border-t border-gray-200">
        <button @click="openPrevious = false" class="text-gray-600 hover:text-gray-900 font-bold text-sm uppercase tracking-wider">
            Cerrar Historial
        </button>
    </div>
</div>
</template>