<div class="flex space-x-2">
    {{-- Editar --}}
    <x-wire-button icon="pencil" blue xs href="{{ route('admin.appointments.edit', $row) }}" />

    {{-- Datos de Consulta --}}
    <x-wire-button green xs href="{{ route('admin.appointments.consult', $row) }}">
        <i class="fa-solid fa-clipboard-list mr-1"></i> Datos de consulta
    </x-wire-button>
</div>