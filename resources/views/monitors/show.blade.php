@extends('layouts.master')

@section('title', 'Monitores')

@section('content')

    <div class="flex items-center gap-2 mb-6">
        <span
            class="@if ($formattedMonitor['status'] == 1) bg-green-500
        @elseif($formattedMonitor['status'] == 2) bg-red-500
        @elseif($formattedMonitor['status'] == 3) bg-yellow-500
        @else bg-gray-400 @endif h-5 w-5 animate-pulse rounded-full">
        </span>
        <h5 class="text-xl font-semibold text-slate-800">
            {{ $formattedMonitor['url'] }}
        </h5>
    </div>

    <div class="flex flex-col gap-4">

        <!-- Primera fila con tres tarjetas -->
        <div class="flex gap-4">
            <div class="flex flex-1 flex-col rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <p class="pb-2 font-light leading-normal text-slate-600">Estado actual</p>
                <h5 class="mb-2 text-xl font-semibold text-slate-800">
                    @if ($formattedMonitor['status'] == 1)
                        Activo
                    @elseif($formattedMonitor['status'] == 2)
                        Inactivo
                    @elseif($formattedMonitor['status'] == 3)
                        En pausa
                    @else
                        Desconocido
                    @endif
                </h5>
                <p class="text-sm font-light text-slate-600">Última caída hace 1 día</p>
            </div>

            <div class="flex flex-1 flex-col rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <p class="pb-2 font-light leading-normal text-slate-600">Último check</p>
                <h5 class="mb-2 text-xl font-semibold text-slate-800">{{ $formattedMonitor['lastCheck'] }}</h5>
                <p class="text-sm font-light text-slate-600">Checking cada {{ $formattedMonitor['interval'] }}
                    segundos</p>
            </div>

            <div class="flex flex-1 flex-col rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <p class="pb-2 font-light leading-normal text-slate-600">Domain & SSL</p>
                <p class="text-sm font-light text-slate-600">Válido hasta</p>
                <h5 class="mb-2 text-xl font-semibold text-slate-800">12 Enero</h5>
            </div>
        </div>

        <!-- Segunda fila con el gráfico -->
        <div class="flex flex-col rounded-xl bg-white p-4 shadow-md">
            <div class="px-2">
                <div id="line-chart"></div>
            </div>
            <div class="flex justify-between pt-4 text-center">
                <div class="flex-1">
                    <h5 class="text-xl font-semibold text-slate-800">{{ $formattedMonitor['responseTimeAvg'] }} ms</h5>
                    <p class="text-sm font-light text-slate-600">Media</p>
                </div>

                <div class="border-l border-gray-300"></div>

                <div class="flex-1">
                    <h5 class="text-xl font-semibold text-slate-800">{{$formattedMonitor['responseTimeMin']}} ms</h5>
                    <p class="text-sm font-light text-slate-600">Mínimo</p>
                </div>

                <div class="border-l border-gray-300"></div>

                <div class="flex-1">
                    <h5 class="text-xl font-semibold text-slate-800">{{$formattedMonitor['responseTimeMax']}} ms</h5>
                    <p class="text-sm font-light text-slate-600">Máximum</p>
                </div>
            </div>
        </div>

        <!-- Última fila con una tarjeta más grande -->
        <div class="flex flex-col rounded-lg border border-slate-200 bg-white p-4 shadow-sm">

            <div class="w-full">
                <h3 class="ml-3 text-lg font-semibold text-slate-800">Últimas Incidencias</h3>
                <p class="mb-5 ml-3 text-slate-500">Últimas 10 incidencias reportadas por el monitor</p>
            </div>

            <div
                class="relative flex h-full w-full flex-col overflow-scroll rounded-lg bg-white bg-clip-border text-gray-700">
                <table class="w-full min-w-max table-auto text-left">
                    <thead>
                    <tr>
                        <th class="border-b border-slate-300 p-4">
                            <p class="block text-sm font-normal leading-none text-slate-500">
                                Status
                            </p>
                        </th>
                        <th class="border-b border-slate-300 p-4">
                            <p class="block text-sm font-normal leading-none text-slate-500">
                                At
                            </p>
                        </th>

                    </tr>
                    </thead>
                    <tbody>

                    @if(count($formattedMonitor['incidents']) > 0)

                        @foreach($formattedMonitor['incidents'] as $history)

                            <tr class="hover:bg-slate-50">
                                <td class="border-b border-slate-200 p-4">
                                    <p class="block text
                                    @if ($history['status'] == 1) text-green-500
                                    @elseif($history['status'] == 2) text-red-500
                                    @elseif($history['status'] == 3) text-yellow-500
                                    @else text-gray-400 @endif
                                        text-sm text-slate-800">
                                        @if ($history['status'] == 1)
                                            Activo
                                        @elseif($history['status'] == 2)
                                            Inactivo
                                        @elseif($history['status'] == 3)
                                            En pausa
                                        @else
                                            Desconocido
                                        @endif
                                    </p>
                                </td>

                                <td class="border-b border-slate-200 p-4">
                                    <p class="block text text-sm text-slate-800">
                                        {{ $history['at'] }}
                                    </p>
                                </td>

                        @endforeach

                    @else
                    @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Extraer datos de incidentes desde Blade y pasarlos como JSON a JavaScript
        const incidents = @json($formattedMonitor['incidents']);

        // Transformar los datos en el formato adecuado para la gráfica
        const categories = incidents.map(incident => incident.at); // Fechas en X
        const responseTimes = incidents.map(incident => incident.responseTime); // Tiempos en Y

        // Configurar el gráfico con los datos dinámicos
        const chartConfig = {
            series: [{
                name: "Tiempo de Respuesta (ms)",
                data: responseTimes
            }],
            chart: {
                type: "line",
                height: 240,
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#020617"],
            stroke: {
                lineCap: "round",
                curve: "smooth"
            },
            markers: {
                size: 4,
                colors: ["#020617"],
            },
            xaxis: {
                categories: categories,
                labels: {
                    style: {
                        colors: "#616161",
                        fontSize: "12px",
                        fontFamily: "inherit",
                        fontWeight: 400
                    },
                    rotate: -45, // Rotar etiquetas de fechas para mejor lectura
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: "#616161",
                        fontSize: "12px",
                        fontFamily: "inherit",
                        fontWeight: 400
                    }
                },
                title: {
                    text: "Tiempo de Respuesta (ms)"
                }
            },
            grid: {
                show: true,
                borderColor: "#dddddd",
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                padding: {
                    top: 5,
                    right: 20
                },
            },
            tooltip: {
                theme: "dark",
                x: {
                    format: "dd MMM HH:mm" // Formato de fecha en tooltip
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#line-chart"), chartConfig);
        chart.render();
    });
</script>
