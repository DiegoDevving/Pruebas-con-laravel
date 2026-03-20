<x-admin-layout
    title="Ver Ticket | Gatocura"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Tickets de Soporte',
            'href' => route('admin.support-tickets.index')
        ],
        [
            'name' => 'Ver Ticket',
        ],
    ]"
>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold">Detalles del Ticket #{{ $supportTicket->id }}</h3>
                <a href="{{ route('admin.support-tickets.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">&larr; Volver a la lista</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="col-span-2 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Mensaje</h4>
                    <p class="text-lg font-medium mb-4">{{ $supportTicket->subject }}</p>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($supportTicket->message)) !!}
                    </div>
                </div>

                <div class="col-span-1 space-y-4">
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Información de Contacto</h4>
                        <p class="font-medium">{{ $supportTicket->name }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            <a href="mailto:{{ $supportTicket->email }}" class="hover:underline">{{ $supportTicket->email }}</a>
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Detalles</h4>
                        <div class="mb-2">
                            <span class="text-xs text-gray-500 block">Estado</span>
                            @if($supportTicket->status === 'abierto')
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Abierto</span>
                            @elseif($supportTicket->status === 'en_progreso')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">En Progreso</span>
                            @else
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Cerrado</span>
                            @endif
                        </div>
                        <div>
                            <span class="text-xs text-gray-500 block">Fecha de Envío</span>
                            <span class="font-medium text-sm">{{ $supportTicket->created_at->format('d M Y, h:i A') }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-4 flex space-x-2">
                         <form action="{{ route('admin.support-tickets.destroy', $supportTicket) }}" method="POST" class="w-full" onsubmit="return confirm('¿Estás seguro de eliminar este ticket? Esta acción no se puede deshacer.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Eliminar Ticket
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
