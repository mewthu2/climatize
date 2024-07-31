<x-app-layout>
    <x-slot name="header">
        <h5 class="text-left font-semibold text-sm text-white leading-tight">
            <i class="fas fa-users"></i> {{ __('Listagem de Sensores') }}
            <x-primary-button class="ml-4" href="{{ route('sensors.create') }}">
                <i class="fas fa-plus"></i> {{ __('Novo Sensor') }}
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

    <form method="GET" action="{{ route('sensors') }}" class="mx-auto container items-center">
        <div class="text-right p-2">
            <input type="text" name="search" class="form-input rounded-md shadow-sm w-full"
                   placeholder="Buscar sensores..." value="{{ request('search') }}">
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
                            <th class="px-6 py-3 border border-gray-300">Cliente</th>
                            <th class="px-6 py-3 border border-gray-300">ID Equipamento</th>
                            <th class="px-6 py-3 border border-gray-300">Mac Sensor</th>
                            <th class="px-6 py-3 border border-gray-300">Status</th>
                            <th class="px-6 py-3 border border-gray-300">IP Cliente</th>
                            <th class="px-6 py-3 border border-gray-300">Criado em</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($sensors as $sensor)
                        <tr>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">
                                <x-primary-button href="{{ route('sensors.edit', $sensor->id) }}">
                                    <span class="font-medium">e</span>
                                </x-primary-button>
                                <x-primary-button href="{{ route('sensors.destroy', $sensor->id) }}">
                                    <span class="font-medium">x</span>
                                </x-primary-button>
                            </td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $sensor->id }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $sensor->cliente->nome ?? 'N/A' }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300 text-center">{{ $sensor->id_equipamento }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $sensor->mac_sensor }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300 text-center">{{ $sensor->status }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $sensor->ip_cliente }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $sensor->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>
