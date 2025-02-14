<div class="flex gap-2">
    <form action="{{ route('monitors.ping', $formattedMonitor['id']) }}" method="POST">
        @csrf
        <x-admin::button text="Ping" type="submit" />
        <x-admin::button href="{{ route('monitors.index') }}" text="Volver" />
    </form>
</div>
