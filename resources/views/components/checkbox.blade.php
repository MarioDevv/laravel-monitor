@props([
    'text' => 'Remember Me', // Texto que se mostrará junto al checkbox
    'id' => 'check-2', // Por si quieres personalizar el ID
    'checked' => false, // Para indicar si el checkbox aparece marcado
])

<div class="inline-flex items-center">
    <label class="relative flex cursor-pointer items-center" for="{{ $id }}">
        <input type="checkbox" id="{{ $id }}"
            class="peer h-4 w-4 cursor-pointer appearance-none rounded border border-slate-300 shadow transition-all checked:border-slate-800 checked:bg-slate-800 hover:shadow-md"
            @if ($checked) checked @endif />
        <span
            class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform text-white opacity-0 peer-checked:opacity-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"
                stroke="currentColor" stroke-width="1">
                <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
            </svg>
        </span>
    </label>
    <label class="ml-2 cursor-pointer text-sm text-slate-600" for="{{ $id }}">
        {{ $text }}
    </label>
</div>
