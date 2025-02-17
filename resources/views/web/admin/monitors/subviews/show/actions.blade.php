<div class="flex items-stretch gap-2">

    <form action="{{ route('monitor.ping', $formattedMonitor['id']) }}" method="POST">
        @csrf
        <x-admin::button text="Ping" type="submit" />
    </form>


    @if ($formattedMonitor['status'] === 3)
        <form action="{{ route('monitor.resume', $formattedMonitor['id']) }}" method="POST">
            @csrf
            @method('PATCH')
            <x-admin::icon-button type="submit">
                <x-icon::play />
            </x-admin::icon-button>
        </form>
    @else
        <form action="{{ route('monitor.stop', $formattedMonitor['id']) }}" method="POST">
            @csrf
            @method('PATCH')
            <x-admin::icon-button type="submit">
                <x-icon::pause />
            </x-admin::icon-button>
        </form>
    @endif

    <form action="{{ route('monitor.delete', $formattedMonitor['id']) }}" method="POST">
        @csrf
        @method('DELETE')
        <x-admin::icon-button type="submit">
            <x-icon::trash />
        </x-admin::icon-button>
    </form>

    <div>
        <x-admin::button href="{{ route('monitors.index') }}" text="Volver" />
    </div>

</div>
