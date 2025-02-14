<div class="relative my-6 flex w-full flex-col rounded-lg border border-slate-200 bg-white p-6 shadow-sm">

    {{-- Tipo de Monitor --}}
    <div>
        <label class="mb-2 block text-sm text-slate-800"><b>Monitor type</b></label>
        <div class="relative">
            <select name="monitor_type" disabled class="pointer-events-none w-full cursor-pointer rounded border border-slate-200 bg-transparent py-2 pl-3 pr-8 text-sm text-slate-700 opacity-50 shadow-sm">
                <option value="curl" selected>Curl</option>
                <option value="ping">Ping</option>
                <option value="port">Port</option>
            </select>
            <input type="hidden" name="monitor_type" value="curl">
        </div>
    </div>

    <hr class="my-5">

    {{-- URL a monitorear --}}
    <div class="w-full">
        <label class="mb-2 block text-sm text-slate-800"><b>URL to monitor</b></label>
        <input type="text" name="url" class="w-full rounded-md border border-slate-200 bg-transparent px-3 py-2 text-sm text-slate-700 shadow-sm" placeholder="http(s)://" />
    </div>

</div>
