@props([
    'href' => null, // Si se define, se renderiza como enlace
    'type' => 'button', // Tipo del botón; para submit se usa "submit"
    'text' => '',
    'ripple' => false,
    'disabled' => false, // Nuevo prop para deshabilitar
])

@php
    $baseClasses =
        'inline-flex items-center justify-center rounded-md border border-transparent bg-slate-800 px-4 py-2 text-center text-sm text-white shadow-md transition-all hover:bg-slate-700 hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none';
@endphp

@if ($href && !$disabled)
    <a href="{{ $href }}" data-ripple-light="{{ $ripple ? 'true' : 'false' }}" class="{{ $baseClasses }} w-auto">
        {{ $text }}
    </a>
@else
    <button type="{{ $type }}" data-ripple-light="{{ $ripple ? 'true' : 'false' }}" class="{{ $baseClasses }}"
        @if ($disabled) disabled @endif>
        {{ $text }}
    </button>
@endif
