@props(['text' => 'Chip', 'color' => 'bg-slate-800 text-white'])

<div class="{{ $color }} rounded-md border border-transparent px-2.5 py-0.5 text-sm shadow-sm transition-all">
    {{ $text }}
</div>
