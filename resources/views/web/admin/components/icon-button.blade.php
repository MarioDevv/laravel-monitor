@props([
    'type' => 'button',
    'ripple' => false,
    'disabled' => false,
])

<button
    class="rounded-md border border-transparent bg-slate-800 p-2.5 text-center text-sm text-white shadow-sm transition-all hover:bg-slate-700 hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
    type="{{ $type }}" @if ($disabled) disabled @endif>
    {{ $slot }}
</button>
