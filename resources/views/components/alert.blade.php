@props([
    'error' => 'Server Error',
])

<div class="fixed left-1/2 top-4 z-50 min-w-64 max-w-[90%] -translate-x-1/2">
    <div role="alert" class="relative flex w-auto rounded-md bg-slate-800 p-3 text-sm text-white shadow">
        {{-- Texto del error --}}
        <span class="pr-8">
            {{ $error }}
        </span>

        {{-- Botón para cerrar la alerta --}}
        <button
            class="absolute right-1.5 top-1.5 flex h-8 w-8 items-center justify-center rounded-md text-white transition-all hover:bg-white/10 active:bg-white/10"
            type="button" onclick="this.parentElement.parentElement.remove();">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="h-5 w-5" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
