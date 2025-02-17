<div class="overflow-auto px-4">
    <table class="mt-4 w-full min-w-max table-auto text-left">
        <thead class="border-b border-slate-200 text-sm font-semibold text-slate-600">
            <tr>
                <th class="py-3">Monitor</th>
                <th class="py-3">Estado</th>
                <th class="py-3">Último check</th>
                <th class="py-3">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-sm text-slate-700">
            @foreach ($monitors as $monitor)
                @php
                    $statusConfig = match ($monitor['status']) {
                        1 => [
                            'color' => 'bg-green-500',
                            'text' => 'Online',
                            'textColor' => 'text-green-700',
                            'bgOpacity' => 'bg-green-500/10',
                        ],
                        2 => [
                            'color' => 'bg-red-500',
                            'text' => 'Down',
                            'textColor' => 'text-red-700',
                            'bgOpacity' => 'bg-red-500/10',
                        ],
                        3 => [
                            'color' => 'bg-yellow-400',
                            'text' => 'Stopped',
                            'textColor' => 'text-yellow-700',
                            'bgOpacity' => 'bg-yellow-400/10',
                        ],
                        4 => [
                            'color' => 'bg-slate-400',
                            'text' => 'Pendiente',
                            'textColor' => 'text-slate-700',
                            'bgOpacity' => 'bg-slate-400/10',
                        ],

                        default => [
                            'color' => 'bg-slate-400',
                            'text' => 'Desconocido',
                            'textColor' => 'text-slate-700',
                            'bgOpacity' => 'bg-slate-400/10',
                        ],
                    };
                @endphp

                <tr class="border-b border-slate-100 hover:bg-slate-50">
                    <td class="py-3 align-middle">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <span
                                    class="{{ $statusConfig['color'] }} absolute h-4 w-4 animate-ping rounded-full opacity-75"></span>
                                <span
                                    class="{{ $statusConfig['color'] }} relative inline-block h-4 w-4 rounded-full"></span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-medium text-slate-800">
                                    {{ $monitor['friendlyName'] }}
                                </span>
                                <span class="text-xs text-slate-500">
                                    {{ $monitor['url'] }}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="py-3 align-middle">
                        <div class="inline-flex items-center gap-2">
                            <span
                                class="{{ $statusConfig['bgOpacity'] }} {{ $statusConfig['textColor'] }} rounded-md px-2 py-1 text-xs font-bold uppercase">
                                {{ $statusConfig['text'] }}
                            </span>
                        </div>
                    </td>
                    <td class="py-3 align-middle">
                        <span class="text-sm text-slate-700">
                            {{ $monitor['lastCheck'] }}
                        </span>
                    </td>
                    <td class="py-3 align-middle">
                        @include('web.admin.monitors.subviews.index.actions', ['monitor' => $monitor])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
