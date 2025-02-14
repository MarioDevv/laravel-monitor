@props([
    'placeholder' => '',
    'name' => '',
    'value' => '',
])

<input type="text" placeholder="{{ $placeholder }}" name="{{ $name }}" value="{{ $value }}"
    {{ $attributes->merge([
        'class' =>
            'peer h-full w-full rounded-md border border-slate-200 bg-transparent px-3 py-2.5 pr-9 text-sm font-normal text-slate-800 placeholder-slate-400 outline-none focus:border-slate-800 focus:ring-0 disabled:cursor-not-allowed',
    ]) }} />
