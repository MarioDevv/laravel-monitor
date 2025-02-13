@extends('layouts.master')

@section('title', 'Monitores')

@section('content')

    <div class="mb-6 flex flex-row justify-between gap-2">


        <div>
            <a href="{{ $formattedMonitor['url'] }}" class="text-2xl font-semibold text-slate-800 underline">
                {{ $formattedMonitor['friendlyName'] }}
            </a>
            <p class="text-xs font-light text-slate-600">{{ $formattedMonitor['url'] }}</p>
        </div>

        <div class="flex gap-2">
            <form action="{{ route('monitors.ping', $formattedMonitor['id']) }}" method="POST">
                @csrf
                <button
                    class="flex w-20 items-center justify-center gap-2 rounded-md border border-transparent bg-slate-800 px-4 py-2 text-center text-sm text-white shadow-md transition-all hover:bg-slate-700 hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="submit" data-ripple-light="true">
                    Ping
                </button>
            </form>

            <a href="{{ route('monitors.index') }}">
                <button
                    class="flex w-20 items-center justify-center gap-2 rounded-md border border-transparent bg-slate-800 px-4 py-2 text-center text-sm text-white shadow-md transition-all hover:bg-slate-700 hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button" data-ripple-light="true">
                    Volver
                </button>
            </a>
        </div>


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
                <h5 class="mb-2 text-xl font-semibold text-slate-800">
                    {{ $formattedMonitor['sslExpiration'] }}
                </h5>
            </div>
        </div>

        <!-- Segunda fila con el gráfico -->
        <div class="flex flex-col rounded-xl bg-white p-4 shadow-md">
            <div class="px-2">
                <div id="line-chart"></div>
            </div>
            <div class="flex justify-between text-center">
                <div class="flex-1">
                    <h5 class="text-xl font-semibold text-slate-800">{{ $formattedMonitor['responseTimeAvg'] }} ms</h5>
                    <p class="text-sm font-light text-slate-600">Media</p>
                </div>

                <div class="border-l border-gray-300"></div>

                <div class="flex-1">
                    <h5 class="text-xl font-semibold text-slate-800">{{ $formattedMonitor['responseTimeMin'] }} ms</h5>
                    <p class="text-sm font-light text-slate-600">Mínimo</p>
                </div>

                <div class="border-l border-gray-300"></div>

                <div class="flex-1">
                    <h5 class="text-xl font-semibold text-slate-800">{{ $formattedMonitor['responseTimeMax'] }} ms</h5>
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

            <div class="max-h-60 overflow-x-auto">
                <!-- Ajustamos la altura máxima y el overflow -->
                <table class="w-full min-w-max table-auto text-left">
                    <thead>
                        <tr>
                            <th class="border-b border-slate-300 p-4">
                                <p class="block text-sm font-normal leading-none text-slate-500">Status</p>
                            </th>
                            <th class="border-b border-slate-300 p-4">
                                <p class="block text-sm font-normal leading-none text-slate-500">At</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($formattedMonitor['incidents']) > 0)
                            @foreach ($formattedMonitor['incidents'] as $history)
                                <tr class="hover:bg-slate-50">
                                    <td class="border-b border-slate-200 p-4">
                                        <p
                                            class="@if ($history['status'] == 1) text-green-500
                  @elseif($history['status'] == 2) text-red-500
                  @else text-gray-400 @endif block text-sm text-slate-800">
                                            @if ($history['status'] == 1)
                                                Activo
                                            @elseif($history['status'] == 2)
                                                Inactivo
                                            @else
                                                Desconocido
                                            @endif
                                        </p>
                                    </td>
                                    <td class="border-b border-slate-200 p-4">
                                        <p class="text block text-sm text-slate-800">
                                            {{ $history['at'] }}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
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
                    formatter: function(val) {
                        // Retornar siempre con 2 decimales
                        return val.toFixed(2);
                    },
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
                },
                y: {
                    formatter: function(val) {
                        // También en el tooltip se muestran 2 decimales
                        return val.toFixed(2);
                    }
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#line-chart"), chartConfig);
        chart.render();
    });
</script>
