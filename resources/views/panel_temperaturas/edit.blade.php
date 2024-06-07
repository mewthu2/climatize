<x-app-layout>
    <x-slot name="header">
        <h5 class="text-left font-semibold text-sm text-white leading-tight">
            <i class="fas fa-thermometer-half"></i> {{ __('Editar Panel Temperatura') }}
        </h5>
    </x-slot>

    <section class="container mx-auto p-4" style="overflow-y: scroll;">
        <form method="POST" action="{{ route('painel_temperaturas.update', $panel->id) }}">
            @csrf
            @method('PUT')

            @if(session()->has('error'))
                <span class="bg-red-100 border border-red-400 text-red-700 rounded">{{ session()->get('error') }}</span>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <x-label class="text-white" for="id_equipamento" :value="__('* ID Equipamento:')" />
                    <x-input id="id_equipamento" class="mt-1 w-full" type="text" name="id_equipamento" :value="old('id_equipamento', $panel->id_equipamento)" required />
                </div>

                <div>
                    <x-label class="text-white" for="mac_sensor" :value="__('* Sensor vinculado:')" />
                    <select id="mac_sensor" name="mac_sensor" class="mt-1 w-full form-select" required>
                        <option value="">{{ __('Selecione um sensor') }}</option>
                        @foreach($sensors as $sensor)
                            <option value="{{ $sensor->mac_sensor }}" {{ old('mac_sensor', $panel->mac_sensor) == $sensor->mac_sensor ? 'selected' : '' }}>
                                {{ $sensor->mac_sensor }}
                            </option>
                        @endforeach
                    </select>
                </div>   

                <div>
                    <x-label class="text-white" for="nome_unidade" :value="__('* Nome Unidade:')" />
                    <x-input id="nome_unidade" class="mt-1 w-full" type="text" name="nome_unidade" :value="old('nome_unidade', $panel->nome_unidade)" required />
                </div>

                <div>
                    <x-label class="text-white" for="etiqueta_ident" :value="__('* Etiqueta Identificação:')" />
                    <x-input id="etiqueta_ident" class="mt-1 w-full" type="text" name="etiqueta_ident" :value="old('etiqueta_ident', $panel->etiqueta_ident)" required />
                </div>

                <div>
                    <x-label class="text-white" for="detalhe" :value="__('Detalhe:')" />
                    <x-input id="detalhe" class="mt-1 w-full" type="text" name="detalhe" :value="old('detalhe', $panel->detalhe)" />
                </div>

                <div>
                    <x-label class="text-white" for="referencia" :value="__('* Referência:')" />
                    <x-input id="referencia" class="mt-1 w-full" type="text" name="referencia" :value="old('referencia', $panel->referencia)" />
                </div>

                <div>
                    <x-label class="text-white" for="cad_cliente_id" :value="__('* Cliente:')" />
                    <select id="cad_cliente_id" name="cad_cliente_id" class="mt-1 w-full form-select" required>
                        <option value="">{{ __('Selecione um cliente') }}</option>
                        @foreach($all_clients as $client)
                            <option value="{{ $client->id }}" {{ old('cad_cliente_id', $panel->cad_cliente_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>            

                <div>
                    <x-label class="text-white" for="setpoint" :value="__('* Setpoint:')" />
                    <x-input id="setpoint" class="mt-1 w-full" type="text" name="setpoint" :value="old('setpoint', $panel->setpoint)" required />
                </div>

                <div>
                    <x-label class="text-white" for="max" :value="__('* Máximo:')" />
                    <x-input id="max" class="mt-1 w-full" type="text" name="max" :value="old('max', $panel->max)" required />
                </div>

                <div>
                    <x-label class="text-white" for="min" :value="__('* Mínimo:')" />
                    <x-input id="min" class="mt-1 w-full" type="text" name="min" :value="old('min', $panel->min)" required />
                </div>

                <div>
                    <x-label class="text-white" for="atu" :value="__('Atual:')" />
                    <x-input id="atu" class="mt-1 w-full" type="text" name="atu" :value="old('atu', $panel->atu)" />
                </div>
            </div>

            <div class="p-4 bg-gray-500 rounded-lg flex items-center justify-center mt-4">
                <x-primary-button class="ml-4">
                    <i class="fas fa-save"></i>&nbsp;{{ __('Salvar') }}
                </x-primary-button>
                <x-primary-button class="ml-4" href="{{ route('painel_temperaturas') }}">
                    <i class="fas fa-undo"></i>&nbsp;{{ __('Voltar') }}
                </x-primary-button>
            </div>
        </form>
    </section>
</x-app-layout>
