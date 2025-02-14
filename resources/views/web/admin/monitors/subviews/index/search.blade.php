<div class="relative mx-4 mt-4">
    <div class="flex flex-row items-center justify-end p-4">
        <div class="block w-full md:w-72">
            <form action="{{ route('monitors.index') }}" method="GET">
                <div class="relative h-10 w-full min-w-[200px]">
                    <div
                        class="pointer-events-none absolute right-3 top-1/2 grid h-5 w-5 -translate-y-1/2 place-items-center text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <input type="hidden" name="filters[0][field]" value="url">
                    <input type="hidden" name="filters[0][operator]" value="CONTAINS">
                    <x-admin::input name="filters[0][value]" value="{{ request('filters.0.value') }}"
                        placeholder="Buscar..." />
                </div>

                <input type="hidden" name="pageSize" value="{{ request('pageSize', 10) }}">
                <input type="hidden" name="pageNumber" value="{{ request('pageNumber', 1) }}">
            </form>
        </div>
    </div>
</div>
