<x-app-layout>
    <x-slot name="header">
        <h5 class="text-left font-semibold text-sm text-white leading-tight">
            <i class="fas fa-thermometer-half"></i> {{ __('Novo Panel Temperatura') }}
        </h5>
    </x-slot>

    <section class="container mx-auto p-4" style="overflow-y: scroll;">
        <form method="POST" action="{{ route('painel_temperaturas.store') }}">
            @csrf

            @if(session()->has('error'))
                <span class="bg-red-100 border border-red-400 text-red-700 rounded">{{ session()->get('error') }}</span>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <x-label class="text-white" for="id_equipamento" :value="__('ID Equipamento *')" />
                    <x-input id="id_equipamento" class="mt-1 w-full" type="text" name="id_equipamento" :value="old('id_equipamento')" required autofocus />
                </div>

                <div>
                    <x-label class="text-white" for="mac_sensor" :value="__('MAC Sensor *')" />
                    <x-input id="mac_sensor" class="mt-1 w-full" type="text" name="mac_sensor" :value="old('mac_sensor')" required autofocus />
                </div>

                <div>
                    <x-label class="text-white" for="nome_unidade" :value="__('Nome Unidade *')" />
                    <x-input id="nome_unidade" class="mt-1 w-full" type="text" name="nome_unidade" :value="old('nome_unidade')" required />
                </div>

                <div>
                    <x-label class="text-white" for="etiqueta_ident" :value="__('Etiqueta Identificação *')" />
                    <x-input id="etiqueta_ident" class="mt-1 w-full" type="text" name="etiqueta_ident" :value="old('etiqueta_ident')" required />
                </div>

                <div>
                    <x-label class="text-white" for="cad_cliente_id" :value="__('Cliente ID *')" />
                    <select id="cad_cliente_id" name="cad_cliente_id" class="mt-1 w-full form-select" required>
                        <option value="">{{ __('Selecione um cliente') }}</option>
                        @foreach($all_clients as $client)
                            <option value="{{ $client->id }}">{{ $client->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-label class="text-white" for="setpoint" :value="__('Setpoint *')" />
                    <x-input id="setpoint" class="mt-1 w-full" type="text" name="setpoint" :value="old('setpoint')" required />
                </div>

                <div>
                    <x-label class="text-white" for="max" :value="__('Máximo *')" />
                    <x-input id="max" class="mt-1 w-full" type="text" name="max" :value="old('max')" required />
                </div>

                <div>
                    <x-label class="text-white" for="min" :value="__('Mínimo *')" />
                    <x-input id="min" class="mt-1 w-full" type="text" name="min" :value="old('min')" required />
                </div>

                <div>
                    <x-label class="text-white" for="atu" :value="__('Atu *')" />
                    <select id="atu" name="atu" class="mt-1 w-full form-select" required>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                </div>
            </div>

            <div class="p-4 bg-gray-500 rounded-lg flex items-center justify-center mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Criar') }}
                </x-primary-button>
                <x-primary-button class="ml-4" href="{{ route('painel_temperaturas') }}">
                    {{ __('Voltar') }}
                </x-primary-button>
            </div>
        </form>
    </section>
</x-app-layout>
