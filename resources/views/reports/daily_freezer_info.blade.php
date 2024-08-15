<x-app-layout>
    <x-slot name="header">
        <h5 class="text-left font-semibold text-sm text-white leading-tight">
            <i class="fa-solid fa-chart-simple"></i> {{ __('Gráficos por Freezers - Diário') }}
        </h5>
    </x-slot>

    <div class="container mx-auto sm:p-6 sm:rounded-tl-md sm:rounded-tr-md">
        <div class="mx-auto px-4 py-4 grid grid-cols-1 gap-1 bg-gray-600 rounded-lg mr-4 ml-4">
            <div class="grid grid-cols-4 lg:py-3 gap-1 column-filter">
                <div class="text-sm px-4 pe-9 col-span-1 text-white">
                    Selecione o freezer:
                </div>
                <select id="select_freezer" class="py-3 px-4 pe-9 col-span-3
                  block w-full border-gray-200 rounded-lg 
                  text-sm focus:border-blue-500 focus:ring-blue-500 
                  disabled:opacity-50 disabled:pointer-events-none dark:white-slate-900
                  dark:border-gray-700 dark:text-dark-400 dark:focus:ring-gray-600">
                    @foreach($cad_freezers as $valor)
                        <option value="{{ $valor->id }}">{{ $valor->etiqueta_ident }}: {{ $valor->referencia }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="px-4 grid grid-cols-4 mt-2 mr-4 ml-4 p-1 gap-1 bg-gray-600 rounded-lg" id="button_container">
            <div class="text-sm lg:py-3 col-span-1">
                <span class="text-white"><i class="far fa-clock"></i> Intervalo de tempo:</span>
            </div>
            <div class="col-span-3 px-4 py-4">
                <x-primary-button class="interval-button" value="24">24h</x-primary-button>
                <x-primary-button class="interval-button" value="12">12h</x-primary-button>
                <x-primary-button class="interval-button" value="6">6h</x-primary-button>
            </div>
            <div id="chart"></div>
        </div>

        <div class="px-4 py-4 grid grid-cols-3 gap-2">
            <div id="loading_status" role="status" style="
                                  position: fixed;
                                  left: 43em;
                                  top: 5em;
                                  display:none;
                              ">
                <svg aria-hidden="true" class="w-10 h-10 text-gray-200 animate-spin dark:text-gray-200 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"></path>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"></path>
                </svg>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var intervalButtons = document.querySelectorAll('.interval-button');
        var chartInstance = null;

        intervalButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var intervalo = this.value;
                var idFreezer = document.getElementById('select_freezer').value;

                var endDate = new Date();
                var startDate = new Date();
                startDate.setHours(endDate.getHours() - intervalo);

                var formattedStartDate = startDate.toISOString();
                var formattedEndDate = endDate.toISOString();

                toggleElementVisibility('loading_status');
                toggleElementVisibility('chart');

                if (chartInstance && typeof chartInstance.destroy === 'function') {
                    chartInstance.destroy(); // Destroi o gráfico anterior antes de criar um novo
                }

                axios.get('/reports/daily_freezer_info', {
                        params: {
                            id_freezer: idFreezer,
                            start_date: formattedStartDate,
                            end_date: formattedEndDate
                        },
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(function (response) {
                        toggleElementVisibility('loading_status');
                        toggleElementVisibility('chart');

                        chartInstance = renderChart(response.data.logs);
                    })
                    .catch(function (error) {
                        toggleElementVisibility('loading_status');
                        console.error(error);
                    });
            });
        });
    });

    function renderChart(data) {
        var series = [];
        var colors = ["#FF0000", "#0000FF", "#00FF00", "#FFFF00", "#FF00FF", "#00FFFF"];
        var colorIndex = 0;

        for (var mac_sensor in data) {
            if (data.hasOwnProperty(mac_sensor)) {
                var sensorData = data[mac_sensor];
                var sensorSeries = {
                    name: mac_sensor,
                    data: sensorData.map(function (item) {
                        return {
                            x: new Date(item.dt_leitura),
                            y: parseFloat(item.temperatura.toFixed(2))
                        };
                    }),
                    color: colors[colorIndex % colors.length]
                };
                series.push(sensorSeries);
                colorIndex++;
            }
        }

        var options = {
            series: series,
            chart: {
                type: 'line',
                stacked: false,
                width: window.innerWidth > 768 ? 1200 : 320,
                height: window.innerWidth > 768 ? 500 : 400,
                zoom: {
                    type: 'x',
                    enabled: true,
                    autoScaleYaxis: true
                },
                toolbar: {
                    autoSelected: 'zoom'
                },
                foreColor: '#ffffff'
            },
            stroke: {
                width: 1,
                curve: 'smooth'
            },
            dataLabels: {
                enabled: false
            },
            markers: {
                size: 0,
                strokeWidth: 0,
                hover: {
                    sizeOffset: 0
                }
            },
            title: {
                text: 'Sensores',
                align: 'left',
                style: {
                    color: '#ffffff'
                }
            },
            fill: {
                type: 'solid',
                color: '#000000',
                gradient: {
                    shadeIntensity: 1,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 90, 100]
                }
            },
            yaxis: {
                title: {
                    text: 'Temperatura (°C)',
                    style: {
                        color: '#ffffff'
                    }
                }
            },
            xaxis: {
                type: 'datetime',
                labels: {
                    datetimeUTC: false
                },
                title: {
                    text: 'Data e Hora',
                    style: {
                        color: '#ffffff'
                    }
                }
            },
            tooltip: {
                shared: false,
                theme: 'dark',
                style: {
                    color: '#ffffff'
                },
                x: {
                    show: false,
                    format: 'dd MMM yyyy HH:mm' // Define o formato para mostrar dia, mês, ano, hora e minuto
                },
                y: {
                    formatter: function(value) {
                        return value.toFixed(2) + ' °C'; // Mostra apenas a temperatura no tooltip
                    },
                    title: {
                        formatter: function () {
                            return ''; // Oculta o nome do sensor
                        }
                    }
                }
            },
            grid: {
                borderColor: '#555',
                strokeDashArray: 3,
                xaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        return chart;
    }

    function toggleElementVisibility(id) {
        var element = document.getElementById(id);
        element.style.display = (element.style.display === "none") ? "block" : "none";
    }
</script>

<style>
    .apexcharts-canvas {
        overflow-y: scroll;
        background: black;
        border-radius: 10px;
    }
    #button_container {
        display: flex;
        align-content: center;
        justify-content: center;
        flex-wrap: wrap;
        align-items: center;
        flex-direction: column;
    }

    .column-filter {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
    }

    #select_freezer {
        width: 300px;
    }
</style>