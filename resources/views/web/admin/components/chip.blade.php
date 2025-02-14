@props(['text' => 'Chip', 'color' => 'bg-slate-800 text-white'])

<span
    class="{{ $color }} inline-block whitespace-nowrap rounded-md border border-transparent px-2.5 py-0.5 text-sm shadow-sm transition-all">
    {{ $text }}
</span>
