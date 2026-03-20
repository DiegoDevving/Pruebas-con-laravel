<x-admin-layout title="Nueva Cita | Gatocura">
    <x-wire-card title="Programar Cita Médica">
        <form action="{{ route('admin.appointments.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Selector de Doctor --}}
                <x-wire-native-select label="Seleccionar Doctor" name="doctor_id" :options="$doctors" 
                    option-label="user.name" option-value="id" />

                {{-- Selector de Paciente --}}
                <x-wire-native-select label="Seleccionar Paciente" name="patient_id" :options="$patients" 
                    option-label="user.name" option-value="id" />

                {{-- Fecha --}}
                <x-wire-input type="date" label="Fecha de la Cita" name="date" />

                {{-- Horarios --}}
                <div class="grid grid-cols-2 gap-2">
                    <x-wire-input type="time" label="Hora Inicio" name="start_time" />
                    <x-wire-input type="time" label="Hora Fin" name="end_time" />
                </div>
            </div>

            <div class="mt-4">
                <x-wire-textarea label="Notas Médicas (Opcional)" name="notes" placeholder="Motivo de la consulta..." />
            </div>

            <div class="flex justify-end mt-6 space-x-3">
                <x-wire-button shadow gray label="Cancelar" href="{{ route('admin.appointments.index') }}" />
                <x-wire-button shadow primary label="Agendar Cita" type="submit" />
            </div>
        </form>
    </x-wire-card>
</x-admin-layout>