<div class="flex items-center justify-between border-t border-slate-100 p-4">
    <p class="text-sm text-slate-500">Página {{ request('pageNumber', 1) }} de
        {{ ceil($count / request('pageSize', 10)) }}</p>

    <div class="flex gap-2">
        <x-admin::button :href="request('pageNumber', 1) > 1
            ? route('monitors.index', array_merge(request()->query(), ['pageNumber' => request('pageNumber', 1) - 1]))
            : null" text="Anterior" :disabled="request('pageNumber', 1) <= 1" />

        <x-admin::button :href="request('pageNumber', 1) < ceil($count / request('pageSize', 10))
            ? route('monitors.index', array_merge(request()->query(), ['pageNumber' => request('pageNumber', 1) + 1]))
            : null" text="Siguiente"
            :disabled="request('pageNumber', 1) >= ceil($count / request('pageSize', 10))" />
    </div>
</div>
