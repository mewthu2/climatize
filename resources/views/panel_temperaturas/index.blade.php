<x-app-layout>
  <x-slot name="header">
      <h5 class="text-left font-semibold text-sm text-white leading-tight">
          <i class="fas fa-thermometer-half"></i> {{ __('Listagem de Painéis') }}
          <x-primary-button class="ml-4" href="{{ route('painel_temperaturas.create') }}">
              <i class="fas fa-plus"></i> {{ __('Novo') }}
          </x-primary-button>

          @if(session()->has('success'))
              <span 
                  x-data="{ show: true }" 
                  x-init="setTimeout(() => show = false, 6000)" 
                  x-show="show" 
                  x-transition:leave="transition ease-in duration-3000" 
                  x-transition:leave-start="opacity-100" 
                  x-transition:leave-end="opacity-0"
                  class="ml-4 p-2 bg-blue-100 border border-blue-400 text-blue-700 rounded" 
                  role="alert"
              >
                  <span>{{ session()->get('success') }}</span>
              </span>
          @elseif(session()->has('error'))
              <span 
                  x-data="{ show: true }" 
                  x-init="setTimeout(() => show = false, 6000)" 
                  x-show="show" 
                  x-transition:leave="transition ease-in duration-3000" 
                  x-transition:leave-start="opacity-100" 
                  x-transition:leave-end="opacity-0"
                  class="ml-4 p-2 bg-red-100 border border-red-400 text-red-700 rounded" 
                  role="alert"
              >
                  <span>{{ session()->get('error') }}</span>
              </span>
          @endif
      </h5>
  </x-slot>

  <form method="GET" action="{{ route('painel_temperaturas') }}" class="mx-auto container items-center">
      <div class="text-right p-2">
          <input type="text" name="search" class="form-input rounded-md shadow-sm w-full"
                 placeholder="Buscar painéis de temperatura..." value="{{ request('search') }}">
          <x-primary-button type="submit" class="mt-2 w-full">
              {{ __('Pesquisar') }}
          </x-primary-button>
      </div>
  </form> 

  <section class="container mx-auto p-2" style="overflow-y: scroll;">
      <div class="w-full mb-8 rounded-lg shadow-lg" style="overflow-y: scroll;">
          <div class="w-full" style="overflow-y: scroll;">
              <table class="w-full overflow-x-auto border-collapse border border-gray-300">
                  <thead>
                      <tr class="text-sm font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                          <th width="50" class="text-center"><i class="fa fa-ellipsis-v"></i></th>
                          <th class="px-6 py-3 border border-gray-300">ID</th>
                          <th class="px-6 py-3 border border-gray-300">ID Equipamento</th>
                          <th class="px-6 py-3 border border-gray-300">MAC Sensor</th>
                          <th class="px-6 py-3 border border-gray-300">Nome Unidade</th>
                          <th class="px-6 py-3 border border-gray-300">Referência</th>
                          <th class="px-6 py-3 border border-gray-300">Etiqueta Identificação</th>
                          <th class="px-6 py-3 border border-gray-300">Detalhe</th>
                          <th class="px-6 py-3 border border-gray-300">Cliente</th>
                          <th class="px-6 py-3 border border-gray-300">Setpoint</th>
                          <th class="px-6 py-3 border border-gray-300">Data Leitura</th>
                          <th class="px-6 py-3 border border-gray-300">Máx</th>
                          <th class="px-6 py-3 border border-gray-300">Mín</th>
                          <th class="px-6 py-3 border border-gray-300">Atual</th>
                      </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($panels as $panel)
                            <tr>
                                <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">
                                    <x-primary-button href="{{ route('painel_temperaturas.edit', $panel->id) }}">
                                        <span class="font-medium">e</span>
                                    </x-primary-button>

                                    <x-danger-button href="{{ route('painel_temperaturas.destroy', $panel->id) }}">
                                        <span class="font-medium">x</span>
                                    </x-danger-button>
                                </td>
                                <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $panel->id }}</td>
                                <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $panel->id_equipamento }}</td>
                                <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $panel->mac_sensor }}</td>
                                <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $panel->nome_unidade }}</td>
                                <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $panel->referencia }}</td>
                                <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $panel->etiqueta_ident }}</td>
                                <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $panel->detalhe }}</td>
                                <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $panel->cliente->nome ?? 'N/A' }}</td>
                                <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $panel->setpoint }}</td>
                                <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $panel->dt_leitura }}</td>
                                <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $panel->max }}</td>
                                <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $panel->min }}</td>
                                <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $panel->atu }}</td>
                            </tr>
                        @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </section>
</x-app-layout>
