<x-admin-layout
    title="Consulta | Gatocura"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Citas', 'href' => route('admin.appointments.index')],
        ['name' => 'Datos de Consulta'],
    ]">

    <livewire:admin.appointments.consult-appointment :appointment="$appointment" />

</x-admin-layout>
