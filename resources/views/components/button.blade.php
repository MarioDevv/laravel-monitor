@props([
    'href' => null, // Si se define, se renderiza como enlace
    'type' => 'button', // Tipo del botón; para submit se usa "submit"
    'text' => '',
    'ripple' => false,
])

@if ($href)
    <a href="{{ $href }}" data-ripple-light="{{ $ripple ? 'true' : 'false' }}"
        class="rounded-md border border-transparent bg-slate-800 px-4 py-2 text-center text-sm text-white shadow-md transition-all hover:bg-slate-700 hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
        {{ $text }}
    </a>
@else
    <button type="{{ $type }}" data-ripple-light="{{ $ripple ? 'true' : 'false' }}"
        class="rounded-md border border-transparent bg-slate-800 px-4 py-2 text-center text-sm text-white shadow-md transition-all hover:bg-slate-700 hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
        {{ $text }}
    </button>
@endif
