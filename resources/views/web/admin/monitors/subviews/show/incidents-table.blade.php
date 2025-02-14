<div class="flex flex-col rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
    <div class="w-full">
        <h3 class="ml-3 text-lg font-semibold text-slate-800">Últimas Incidencias</h3>
        <p class="mb-5 ml-3 text-slate-500">Últimas 20 incidencias reportadas por el monitor</p>
    </div>

    <div class="max-h-60 overflow-x-auto">
        <table class="w-full min-w-max table-auto text-left">
            <thead>
                <tr>
                    <th class="border-b border-slate-300 p-4 text-sm text-slate-500">HTTP Code</th>
                    <th class="border-b border-slate-300 p-4 text-sm text-slate-500">Status</th>
                    <th class="border-b border-slate-300 p-4 text-sm text-slate-500">At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($formattedMonitor['incidents'] as $history)
                    @php
                        $chipColor =
                            $history['httpStatus'] >= 400 ? 'bg-red-300 text-white' : 'bg-slate-800 text-white';
                    @endphp
                    <tr class="hover:bg-slate-50">
                        <td class="border-b border-slate-200 p-4">
                            <x-admin::chip :text="$history['httpStatus']" :color="$chipColor" />
                        </td>
                        <td class="border-b border-slate-200 p-4">
                            <p class="text-sm text-slate-800">
                                {{ $history['status'] == 1 ? 'Activo' : 'Inactivo' }}
                            </p>
                        </td>
                        <td class="border-b border-slate-200 p-4">
                            <p class="text-sm text-slate-800">{{ $history['at'] }}</p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
