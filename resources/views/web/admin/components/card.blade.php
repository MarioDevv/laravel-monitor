@props(['title'])

<div class="flex flex-1 flex-col rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
    <p class="pb-2 font-light leading-normal text-slate-600">{{ $title }}</p>
    <h5 class="mb-2 text-xl font-semibold text-slate-800">
        {{ $slot }}
    </h5>
</div>
