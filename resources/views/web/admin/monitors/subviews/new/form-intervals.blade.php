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

        <!-- Slider para el intervalo -->
        <input id="intervalRange" type="range" name="interval" min="0" max="2" step="1"
            value="0" class="w-full cursor-pointer accent-slate-800" oninput="updateIntervalLabel(this.value)" />
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

        <!-- Slider para el timeout -->
        <input id="advancedIntervalRange" type="range" name="timeout" min="0" max="3" step="1"
            value="0" class="my-2 w-full cursor-pointer accent-slate-800"
            oninput="updateAdvancedIntervalLabel(this.value)" />
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
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

        // Asignar eventos iniciales en caso de recargar la página con valores preseleccionados
        updateIntervalLabel(document.getElementById('intervalRange').value);
        updateAdvancedIntervalLabel(document.getElementById('advancedIntervalRange').value);
    });
</script>
