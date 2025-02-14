<div class="flex items-center gap-2">
    <button onclick="window.location.href='{{ route('monitors.show', $monitor['id']) }}'"
        class="relative inline-flex h-9 w-9 items-center justify-center rounded-md text-slate-600 transition-colors hover:bg-slate-100">
        <x-icon::eye />
    </button>

    <button
        class="relative inline-flex h-9 w-9 items-center justify-center rounded-md text-slate-600 transition-colors hover:bg-slate-100">
        <x-icon::edit />
    </button>

    <form action="{{ route('monitors.delete', $monitor['id']) }}" method="POST">
        @csrf
        @method('DELETE')
        <button
            class="relative inline-flex h-9 w-9 items-center justify-center rounded-md text-slate-600 transition-colors hover:bg-slate-100">
            <x-icon::trash />
        </button>
    </form>
</div>
