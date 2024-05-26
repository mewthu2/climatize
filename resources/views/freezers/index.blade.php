<x-app-layout>
    <x-slot name="header">
        <h5 class="text-left font-semibold text-sm text-white leading-tight">
            <i class="fas fa-users"></i> {{ __('Listagem de Freezers') }}
            <x-primary-button class="ml-4" href="{{ route('freezers.create') }}">
                {{ __('Novo Freezer') }}
            </x-primary-button>
        </h5>
    </x-slot>
    
    @if(session()->has('success'))
        <div class="container mx-auto p-2 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session()->get('success') }}</span>
        </div>
    @elseif(session()->has('error'))
        <div class="container mx-auto p-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session()->get('error') }}</span>
        </div>
    @endif

    <section class="container mx-auto p-2" style="overflow-y: scroll;">
        <div class="w-full mb-8 rounded-lg shadow-lg" style="overflow-y: scroll;">
            <div class="w-full" style="overflow-y: scroll;">
                <table class="w-full overflow-x-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="text-sm font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            <th width="50" class="text-center"><i class="fa fa-ellipsis-v"></i></th>
                            <th class="px-6 py-3 border border-gray-300">ID Equipamento</th>
                            <th class="px-6 py-3 border border-gray-300">Mac Sensor</th>
                            <th class="px-6 py-3 border border-gray-300">Nome Unidade</th>
                            <th class="px-6 py-3 border border-gray-300">Referência</th>
                            <th class="px-6 py-3 border border-gray-300">Detalhe</th>
                            <th class="px-6 py-3 border border-gray-300">Setpoint</th>
                            <th class="px-6 py-3 border border-gray-300">Etiqueta Ident</th>
                            <th class="px-6 py-3 border border-gray-300">Limite Neg</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($freezers as $freezer)
                        <tr>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300"><!-- Ações --></td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->id_equipamento }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->mac_sensor }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->nome_unidade }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->referencia }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->detalhe }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->setpoint }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->etiqueta_ident }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->limite_neg }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>
