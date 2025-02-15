<div class="flex w-3/12 flex-col gap-2">

    <x-admin::button href="{{ route('monitors.new') }}" text="New Monitor" />

    <div class="relative flex h-[12rem] flex-col justify-between rounded-lg bg-white p-6 text-slate-700 shadow-md">
        <h3 class="font-semibold">Current Status</h3>

        <div class="flex items-center justify-around gap-4">
            <div class="flex flex-col items-center">
                <span class="text-2xl font-semibold">{{ $summary['down'] ?? 0 }}</span>
                <span class="text-xs text-slate-500">Down</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-2xl font-semibold">{{ $summary['up'] ?? 0 }}</span>
                <span class="text-xs text-slate-500">Up</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-2xl font-semibold">{{ $summary['stopped'] ?? 0 }}</span>
                <span class="text-xs text-slate-500">Stopped</span>
            </div>
        </div>

        <p class="text-center text-xs text-slate-500">
            Using {{ $summary['use'] ?? 0 }} of {{ $summary['total'] ?? 10 }} monitors
        </p>
    </div>

</div>
