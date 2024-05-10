<x-app-layout>
  <x-slot name="header">
    <h5 class="text-left font-semibold text-sm text-white leading-tight">
      <i class="fa-solid fa-chart-simple"></i> {{ __('Gráficos por Freezers') }}
    </h5>
  </x-slot>

  <div class="">
    <div class="px-4 py-4 grid grid-cols-1 gap-1 mt-2">
      <div class="grid grid-cols-4 gap-1">
        <div class="text-xs lg:py-3 lg:px-4 lg:pe-9 col-span-1">
          Selecione o sensor:
        </div>
        <select id="select_freezer" class="lg:py-3 lg:px-4 lg:pe-9 col-span-3
                block w-full border-gray-200 rounded-lg 
                text-sm focus:border-blue-500 focus:ring-blue-500 
                disabled:opacity-50 disabled:pointer-events-none dark:white-slate-900
                dark:border-gray-700 dark:text-dark-400 dark:focus:ring-gray-600">
          @foreach($cad_freezers as $valor)
            <option value="{{ $valor->etiqueta_ident }}">{{ $valor->etiqueta_ident }}: {{ $valor->referencia }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="px-4 grid grid-cols-4 gap-1" id="button_container">
      <div class="text-xs py-3 lg:py-3 lg:px-4 lg:pe-9 col-span-1">
        Filtros: 
      </div>
      <div class="py-3 col-span-3">
        <x-primary-button class="interval-button" value="24">24h</x-primary-button>
        <x-primary-button class="interval-button" value="12">12h</x-primary-button>
        <x-primary-button class="interval-button" value="6">6h</x-primary-button>
      </div>
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
      <div id="chart" style="overflow-y:scroll;"></div>
    </div>
  </div>
</x-app-layout>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var intervalButtons = document.querySelectorAll('.interval-button');

    intervalButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var intervalo = this.value;
            var etiquetaIdentFreezer = document.getElementById('select_freezer').value;

            toggleElementVisibility('loading_status');
            toggleElementVisibility('chart');

            axios.get('/reports/freezer_info', {
                params: {
                    etiqueta_ident_freezer: etiquetaIdentFreezer,
                    intervalo: intervalo
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(function(response) {
                toggleElementVisibility('loading_status');
                toggleElementVisibility('chart');
                console.log(response.data);
                renderChart(response.data);
            })
            .catch(function(error) {
                toggleElementVisibility('loading_status');
                console.error(error);
            });
        });
    });
  });

  function renderChart(data) {
      var series = [];

      series.push({
          name: "Max",
          data: data.map(function(item) {
              return { x: new Date(item.dt_leitura), y: parseFloat(item.max.toFixed(2)) };
          })
      });

      series.push({
          name: "Temp",
          data: data.map(function(item) {
              return { x: new Date(item.dt_leitura), y: parseFloat(item.temperatura.toFixed(2)) };
          })
      });

      series.push({
          name: "Min",
          data: data.map(function(item) {
              return { x: new Date(item.dt_leitura), y: parseFloat(item.min.toFixed(2)) };
          })
      });

      series.push({
          name: "SetPoint",
          data: data.map(function(item) {
              return { x: new Date(item.dt_leitura), y: parseFloat(item.setpoint.toFixed(2)) };
          })
      });

      var options = {
          series: series,
          chart: {
              type: 'area',
              stacked: false,
              width: window.innerWidth > 768 ? 1100 : 300,
              height: window.innerWidth > 768 ? 400 : 300,
              zoom: {
                  type: 'x',
                  enabled: true,
                  autoScaleYaxis: true
              },
              toolbar: {
                  autoSelected: 'zoom'
              }
          },
          dataLabels: {
              enabled: false
          },
          markers: {
              size: 0,
          },
          title: {
              text: 'Média de temperatura do sensor',
              align: 'left'
          },
          fill: {
              type: 'gradient',
              gradient: {
                  shadeIntensity: 1,
                  inverseColors: false,
                  opacityFrom: 0.5,
                  opacityTo: 0,
                  stops: [0, 90, 100]
              },
          },
          yaxis: {
              title: {
                  text: 'Temperatura'
              },
          },
          xaxis: {
              type: 'datetime',
              labels: {
                  formatter: function(val) {
                      return new Date(val).toLocaleTimeString('pt-BR', {
                          hour: '2-digit',
                          minute: '2-digit',
                          hour12: false
                      });
                  }
              }
          },
          tooltip: {
              shared: false,
          },
          colors: ["#FF0000", "#0000FF", "#FF0000", "#000000"],
          legend: {
              position: 'bottom'
          },
      };

      var chart = new ApexCharts(document.querySelector("#chart"), options);
      chart.render();
  }

  function toggleElementVisibility(id) {
      var element = document.getElementById(id);
      if (element.style.display === 'none') {
          element.style.display = 'block';
      } else {
          element.style.display = 'none';
      }
  }

</script>




