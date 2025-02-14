<div class="flex flex-col rounded-xl bg-white p-4 shadow-md">
    <div class="px-2">
        <div id="line-chart"></div>
    </div>
    <div class="flex justify-between text-center">
        <x-admin::metric title="Media" :value="$formattedMonitor['responseTimeAvg'] . ' ms'" />
        <x-admin::metric title="Mínimo" :value="$formattedMonitor['responseTimeMin'] . ' ms'" />
        <x-admin::metric title="Máximo" :value="$formattedMonitor['responseTimeMax'] . ' ms'" />
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof ApexCharts !== 'undefined') {
            const incidents = @json($formattedMonitor['incidents']);

            const categories = incidents.map(incident => incident.at); // Fechas en X
            const responseTimes = incidents.map(incident => incident.responseTime); // Tiempos en Y

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
                        },
                        rotate: -45,
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return val.toFixed(2);
                        },
                        style: {
                            colors: "#616161",
                            fontSize: "12px",
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
                },
                tooltip: {
                    theme: "dark",
                    x: {
                        format: "dd MMM HH:mm"
                    },
                    y: {
                        formatter: function(val) {
                            return val.toFixed(2);
                        }
                    }
                }
            };

            const chartElement = document.querySelector("#line-chart");

            if (chartElement) {
                const chart = new ApexCharts(chartElement, chartConfig);
                chart.render();
            } else {
                console.error("Elemento del gráfico no encontrado.");
            }
        } else {
            console.error("ApexCharts no está cargado.");
        }
    });
</script>
