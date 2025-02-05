@extends('layouts.master')

@section('title', 'Nuevo monitor')

@section('content')
    <form method="POST" action="{{ route('monitors.store') }}">
        @csrf
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-semibold text-slate-800">
                New Monitor
            </h2>
            <x-button href="{{ route('monitors.index') }}" text="Volver" :ripple="true" />
        </div>

        <!-- Primer bloque: Datos generales -->
        <div class="relative my-6 flex w-full flex-col rounded-lg border border-slate-200 bg-white p-6 shadow-sm">

            {{-- Tipo de Monitor --}}
            <div>
                <label class="mb-2 block text-sm text-slate-800"><b>Monitor type</b></label>
                <div class="relative">
                    <select name="monitor_type" disabled
                        class="ease pointer-events-none w-full cursor-pointer appearance-none rounded border border-slate-200 bg-transparent py-2 pl-3 pr-8 text-sm text-slate-700 opacity-50 shadow-sm transition duration-300 placeholder:text-slate-400 hover:border-slate-400 focus:border-slate-400 focus:shadow-md focus:outline-none">
                        <option value="curl" selected>Curl</option>
                        <option value="ping">Ping</option>
                        <option value="port">Port</option>
                    </select>
                    <!-- Si el select está disabled y necesitas enviar su valor, añade un hidden -->
                    <input type="hidden" name="monitor_type" value="curl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                        stroke="currentColor" class="absolute right-2.5 top-2.5 ml-1 h-5 w-5 text-slate-700">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                    </svg>
                </div>
            </div>

            <hr class="my-5">

            {{-- URL a monitorear --}}
            <div class="w-full">
                <label class="mb-2 block text-sm text-slate-800"><b>URL to monitor</b></label>
                <input type="text" name="url"
                    class="ease w-full rounded-md border border-slate-200 bg-transparent px-3 py-2 text-sm text-slate-700 shadow-sm transition duration-300 placeholder:text-slate-400 hover:border-slate-300 focus:border-slate-400 focus:shadow focus:outline-none"
                    placeholder="http(s)://" />
            </div>

            <hr class="my-5">

            {{-- Método de Notificación --}}
            <div class="w-full">
                <label class="block text-sm text-slate-800"><b>How will we notify you?</b></label>

                <div class="mt-5 flex justify-around">
                    <!-- Cada checkbox debe tener un name (por ejemplo, booleanos o parte de un array) -->
                    <div class="flex flex-col">
                        <x-checkbox text="Email" id="email" name="notify_email" :checked="true" />
                        <p class="max-w-3xl text-sm font-light leading-relaxed text-slate-500">
                            mario@atsys.es
                        </p>
                    </div>
                    <div class="flex flex-col">
                        <x-checkbox text="SMS Message" id="sms" name="notify_sms" :checked="false" />
                        <p class="max-w-3xl cursor-pointer text-sm font-light leading-relaxed text-slate-800 underline">
                            Add phone number
                        </p>
                    </div>
                    <div class="flex flex-col">
                        <x-checkbox text="Voice call" id="call" name="notify_call" :checked="false" />
                        <p class="max-w-3xl cursor-pointer text-sm font-light leading-relaxed text-slate-800 underline">
                            Add phone number
                        </p>
                    </div>
                    <div class="flex flex-col">
                        <x-checkbox text="Mobile push" id="push" name="notify_push" :checked="false" />
                        <p class="max-w-3xl text-sm font-light leading-relaxed text-slate-800">
                            Working on it...
                        </p>
                    </div>
                </div>

                <p class="mt-8 max-w-3xl text-sm font-light leading-relaxed text-slate-800">
                    You can set these variables in your <span class="underline">user profile</span>
                </p>
            </div>
        </div>

        <!-- Segundo bloque: Configuración de intervalos -->
        <div class="relative my-6 flex w-full flex-col rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <div class="w-full">
                <label class="mb-2 block text-sm text-slate-800"><b>How often should we check?</b></label>

                <div class="mb-3 text-sm text-slate-600">
                    Your monitor will be checked every <span id="intervalValue" class="font-semibold">30s</span>.
                </div>

                <div class="mb-2 flex items-center justify-between">
                    <span class="text-xs text-slate-500">30s</span>
                    <span class="text-xs text-slate-500">1m</span>
                    <span class="text-xs text-slate-500">5m</span>
                </div>

                <!-- Slider para el intervalo básico; se asigna un name para enviarlo -->
                <input id="intervalRange" type="range" name="interval" min="0" max="2" step="1"
                    value="0" class="w-full cursor-pointer accent-slate-800"
                    oninput="updateIntervalLabel(this.value)" />
            </div>

            <hr class="my-5">

            <div class="w-full">
                <label class="mb-2 block text-sm text-slate-800"><b>Advance Settings</b></label>
                <p class="mb-3 mt-2 text-xs text-slate-500">
                    The request timeout is <span id="advancedIntervalValue" class="font-semibold">5s</span> seconds.
                    The shorter the timeout, the earlier we mark the website as down.
                </p>

                <div class="mb-2 flex items-center justify-between">
                    <span class="text-xs text-slate-500">5s</span>
                    <span class="text-xs text-slate-500">10s</span>
                    <span class="text-xs text-slate-500">45s</span>
                    <span class="text-xs text-slate-500">1m</span>
                </div>

                <!-- Slider para el timeout; también se asigna un name -->
                <input id="advancedIntervalRange" type="range" name="timeout" min="0" max="3" step="1"
                    value="0" class="my-2 w-full cursor-pointer accent-slate-800"
                    oninput="updateAdvancedIntervalLabel(this.value)" />
            </div>

            <!-- Botón para enviar el formulario -->
            <div class="mt-6">
                <x-button type="submit" text="Create Monitor" :ripple="true" />
            </div>
        </div>
    </form>
@endsection

<script>
    // Mapeo para el primer range (intervalos básicos)
    const intervalsMap = ['30s', '1m', '5m'];

    function updateIntervalLabel(value) {
        const index = Number(value);
        document.getElementById('intervalValue').textContent = intervalsMap[index];
    }

    // Mapeo para el segundo range (timeout avanzado)
    const advancedIntervalsMap = ['5s', '10s', '45s', '1m'];

    function updateAdvancedIntervalLabel(value) {
        const index = Number(value);
        document.getElementById('advancedIntervalValue').textContent = advancedIntervalsMap[index];
    }
</script>
