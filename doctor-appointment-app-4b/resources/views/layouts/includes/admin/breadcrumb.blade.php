{{-- Verifica si hay un elemento en el arreglo breadcrumb --}}
@if (count($breadcrumbs))
    {{-- mb: margin bottom --}}
    <nav class="mb-2 block">
        <ol class="flex flex-wrap text-slate-700 text-sm">
            @foreach ($breadcrumbs as $item)
                {{-- centra los li --}}
                <li class="flex items-center">
                    {{-- Si NO es el primer elemento, usa "/" --}}
                    @unless ($loop->first)
                        {{-- Padding del eje x --}}
                        <span class="px-2 text-gray-400">/</span>
                    @endunless

                    @isset($item['href'])
                        {{-- Si existe href, muestralo --}}
                        <a href="{{ $item['href'] }}" class="opacity-60 hover:opacity-100 transition">
                            {{ $item['name'] }}
                        </a>
                    @else
                        {{-- Si no hay href --}}
                        {{ $item['name'] }}
                    @endisset
                </li>
            @endforeach
        </ol>

        {{-- El ultimo item apareceria resaltado --}}
        @if(count($breadcrumbs) > 1)
            {{-- mt: margin top --}}
            <h6 class="font-bold mt-2">
                {{ $breadcrumbs[count($breadcrumbs) - 1]['name'] }}
            </h6>
        @endif
    </nav>
@endif
