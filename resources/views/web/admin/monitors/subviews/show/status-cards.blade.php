<div class="flex gap-4">
    <x-admin::card title="Estado actual">
        @if ($formattedMonitor['status'] == 1)
            Activo
        @elseif($formattedMonitor['status'] == 2)
            Inactivo
        @elseif($formattedMonitor['status'] == 3)
            En pausa
        @else
            Desconocido
        @endif
        <p class="text-sm font-light text-slate-600">Última caída hace 1 día</p>
    </x-admin::card>

    <x-admin::card title="Último check">
        {{ $formattedMonitor['lastCheck'] }}
        <p class="text-sm font-light text-slate-600">Checking cada {{ $formattedMonitor['interval'] }} segundos</p>
    </x-admin::card>

    <x-admin::card title="Domain & SSL">
        {{ $formattedMonitor['sslExpiration'] }}
        <p class="text-sm font-light text-slate-600">Válido hasta</p>
    </x-admin::card>
</div>
