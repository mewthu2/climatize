<x-app-layout>
    <x-slot name="header">
        <h5 class="text-left font-semibold text-sm text-white leading-tight">
            <i class="fas fa-users"></i> {{ __('Listagem de Freezers') }}
        </h5>
    </x-slot>
  
    <section class="container mx-auto p-2 font-mono" style="overflow-y: scroll;">
        <div class="w-full mb-8 rounded-lg shadow-lg" style="overflow-y: scroll;">
            <div class="w-full" style="overflow-y: scroll;">
                <table class="w-full overflow-x-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="text-sm font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-6 py-3 border border-gray-300">ID Equipamento</th>
                            <th class="px-6 py-3 border border-gray-300">Mac Sensor</th>
                            <th class="px-6 py-3 border border-gray-300">Nome Unidade</th>
                            <th class="px-6 py-3 border border-gray-300">Referência</th>
                            <th class="px-6 py-3 border border-gray-300">Detalhe</th>
                            <th class="px-6 py-3 border border-gray-300">Setpoint</th>
                            <th class="px-6 py-3 border border-gray-300">Etiqueta Ident</th>
                            <th class="px-6 py-3 border border-gray-300">Limite Neg</th>
                            <th class="px-6 py-3 border border-gray-300">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($freezers as $freezer)
                        <tr>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->id_equipamento }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->mac_sensor }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->nome_unidade }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->referencia }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->detalhe }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->setpoint }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->etiqueta_ident }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $freezer->limite_neg }}</td>
                            <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300"><!-- Ações --></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
  </x-app-layout>
  