<x-app-layout>
    <x-slot name="header">
        <h5 class="text-left font-semibold text-sm text-white leading-tight">
            <i class="fas fa-users"></i> {{ __('Listagem de Freezers') }}
            <x-primary-button class="ml-4" href="{{ route('freezers.create') }}">
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

    <form method="GET" action="{{ route('freezers') }}" class="mx-auto container items-center">
        <div class="text-right p-2">
            <input type="text" name="search" class="form-input rounded-md shadow-sm w-full"
                   placeholder="Buscar freezers..." value="{{ request('search') }}">
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
                            <th class="px-6 py-3 border border-gray-300">Equipamento</th>
                            <th class="px-6 py-3 border border-gray-300">Sensor</th>
                            <th class="px-6 py-3 border border-gray-300">Min/Set/Max</th>
                            <th class="px-6 py-3 border border-gray-300">Nome Unidade</th>
                            <th class="px-6 py-3 border border-gray-300">Referência</th>
                            <th class="px-6 py-3 border border-gray-300">Detalhe</th>
                            <th class="px-6 py-3 border border-gray-300">Cliente</th>
                            <th class="px-6 py-3 border border-gray-300">Etiqueta Ident</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($freezers as $freezer)
                        <tr>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">
                                <x-primary-button href="{{ route('freezers.edit', $freezer->id) }}">
                                    <span class="font-medium">e</span>
                                </x-primary-button>                                  
                                <x-primary-button href="{{ route('freezers.destroy', $freezer->id) }}">
                                    <span class="font-medium">x</span>
                                </x-primary-button> 
                            </td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->statusSensor()->first()->id_equipamento }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->statusSensor()->first()->mac_sensor }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border text-center border-gray-300">{{ $freezer->limite_neg }}, {{ $freezer->setpoint }}, {{ $freezer->limite_pos }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->nome_unidade }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->referencia }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->detalhe }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->cliente->nome ?? 'N/A' }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->etiqueta_ident }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>
