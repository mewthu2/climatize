<x-app-layout>
    <x-slot name="header">
        <h5 class="text-left font-semibold text-sm text-white leading-tight">
            <i class="fas fa-users"></i> {{ __('Novo Freezer') }}
        </h5>
    </x-slot>
    
    <section class="container mx-auto p-4" style="overflow-y: scroll;">
        <form method="POST" action="{{ route('freezers.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                <div>
                    <x-label class="text-white" for="cad_cliente_id" :value="__('* Cliente:')" />
                    <select id="cad_cliente_id" name="cad_cliente_id" class="mt-1 w-full form-select" required>
                        <option value="">{{ __('Selecione um cliente') }}</option>
                        @foreach($all_clients as $client)
                            <option value="{{ $client->id }}" {{ old('cad_cliente_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-label class="text-white" for="mac_sensor" :value="__('Mac Sensor *')" />
                    <x-input id="mac_sensor" class="mt-1 w-full" type="text" name="mac_sensor" :value="old('mac_sensor')" required />
                </div>

                <div>
                    <x-label class="text-white" for="nome_unidade" :value="__('Nome Unidade *')" />
                    <x-input id="nome_unidade" class="mt-1 w-full" type="text" name="nome_unidade" :value="old('nome_unidade')" required />
                </div>

                <div>
                    <x-label class="text-white" for="referencia" :value="__('Referência *')" />
                    <x-input id="referencia" class="mt-1 w-full" type="text" name="referencia" :value="old('referencia')" required />
                </div>

                <div>
                    <x-label class="text-white" for="detalhe" :value="__('Detalhe *')" />
                    <x-input id="detalhe" class="mt-1 w-full" type="text" name="detalhe" :value="old('detalhe')" required />
                </div>

                <div>
                    <x-label class="text-white" for="setpoint" :value="__('Setpoint *')" />
                    <x-input id="setpoint" class="mt-1 w-full" type="text" name="setpoint" :value="old('setpoint')" required />
                </div>

                <div>
                    <x-label class="text-white" for="etiqueta_ident" :value="__('Etiqueta Ident *')" />
                    <x-input id="etiqueta_ident" class="mt-1 w-full" type="text" name="etiqueta_ident" :value="old('etiqueta_ident')" required />
                </div>

                <div>
                    <x-label class="text-white" for="limite_neg" :value="__('Limite Neg *')" />
                    <x-input id="limite_neg" class="mt-1 w-full" type="text" name="limite_neg" :value="old('limite_neg')" required />
                </div>

                <div>
                    <x-label class="text-white" for="limite_pos" :value="__('Limite Pos *')" />
                    <x-input id="limite_pos" class="mt-1 w-full" type="text" name="limite_pos" :value="old('limite_pos')" required />
                </div>

                <div>
                    <x-label class="text-white" for="status_sensor_id" :value="__('Status Sensor *')" />
                    <select id="status_sensor_id" name="status_sensor_id" class="mt-1 w-full form-select" required>
                        <option value="">{{ __('Selecione um status sensor') }}</option>
                        @foreach($status_sensors as $status_sensor)
                            <option value="{{ $status_sensor->id }}" {{ old('status_sensor_id') == $status_sensor->id ? 'selected' : '' }}>
                                {{ $status_sensor->mac_sensor }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="p-4 bg-gray-500 rounded-lg flex items-center justify-center mt-4">
                <x-primary-button class="ml-4">
                    <i class="fas fa-save"></i>&nbsp;{{ __('Criar') }}
                </x-primary-button>
                <x-primary-button class="ml-4" href="{{ route('freezers') }}">
                    <i class="fas fa-undo"></i>&nbsp;{{ __('Voltar') }}
                </x-primary-button>
            </div>
        </form>
    </section>
</x-app-layout>
