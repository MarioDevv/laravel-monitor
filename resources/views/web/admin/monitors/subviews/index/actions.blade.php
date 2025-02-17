<div class="flex items-center">
    <button onclick="window.location.href='{{ route('monitor.show', $monitor['id']) }}'"
        class="relative inline-flex h-9 w-9 items-center justify-center rounded-md text-slate-600 transition-colors hover:bg-slate-100">
        <x-icon::eye />
    </button>
</div>
