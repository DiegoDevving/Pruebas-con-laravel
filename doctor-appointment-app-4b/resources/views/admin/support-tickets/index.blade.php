<x-admin-layout
    title="Tickets de Soporte | Gatocura"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Tickets de Soporte',
        ],
    ]"
>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <h3 class="text-lg font-medium mb-4">Lista de Tickets</h3>
            
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nombre</th>
                            <th scope="col" class="px-6 py-3">Asunto</th>
                            <th scope="col" class="px-6 py-3">Estado</th>
                            <th scope="col" class="px-6 py-3">Fecha</th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $ticket->name }} <br>
                                    <span class="text-xs text-gray-500">{{ $ticket->email }}</span>
                                </th>
                                <td class="px-6 py-4">
                                    {{ Str::limit($ticket->subject, 30) }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($ticket->status === 'abierto')
                                        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Abierto</span>
                                    @elseif($ticket->status === 'en_progreso')
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">En Progreso</span>
                                    @else
                                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Cerrado</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $ticket->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-right flex space-x-2 justify-end">
                                    <a href="{{ route('admin.support-tickets.show', $ticket) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver</a>
                                    
                                    <form action="{{ route('admin.support-tickets.destroy', $ticket) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este ticket?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline ml-2">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colspan="5" class="px-6 py-4 text-center">
                                    No hay tickets de soporte registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
