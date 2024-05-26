<x-app-layout>
    <x-slot name="header">
        <h5 class="text-left font-semibold text-sm text-white leading-tight">
            <i class="fas fa-users"></i> {{ __('Novo Freezer') }}
        </h5>
    </x-slot>
    
    <section class="container mx-auto p-4" style="overflow-y: scroll;">
        <form method="POST" action="{{ route('freezers.store') }}">
            @csrf

            <div class="grid grid-cols-4 gap-2">
                <div class="mt-2">
                    <x-label for="id_equipamento" :value="__('ID do Equipamento')" />
                    <x-input id="id_equipamento" class="mt-1" type="text" name="id_equipamento" :value="old('id_equipamento')" required autofocus />
                </div>

                <div class="mt-2">
                    <x-label for="mac_sensor" :value="__('Mac Sensor')" />
                    <x-input id="mac_sensor" class="mt-1" type="text" name="mac_sensor" :value="old('mac_sensor')" required />
                </div>

                <div class="mt-2">
                    <x-label for="nome_unidade" :value="__('Nome Unidade')" />
                    <x-input id="nome_unidade" class="mt-1" type="text" name="nome_unidade" :value="old('nome_unidade')" required />
                </div>

                <div class="mt-2">
                    <x-label for="referencia" :value="__('Referência')" />
                    <x-input id="referencia" class="mt-1" type="text" name="referencia" :value="old('referencia')" required />
                </div>

                <div class="mt-2">
                    <x-label for="detalhe" :value="__('Detalhe')" />
                    <x-input id="detalhe" class="mt-1" type="text" name="detalhe" :value="old('detalhe')" required />
                </div>

                <div class="mt-2">
                    <x-label for="setpoint" :value="__('Setpoint')" />
                    <x-input id="setpoint" class="mt-1" type="text" name="setpoint" :value="old('setpoint')" required />
                </div>

                <div class="mt-2">
                    <x-label for="etiqueta_ident" :value="__('Etiqueta Ident')" />
                    <x-input id="etiqueta_ident" class="mt-1" type="text" name="etiqueta_ident" :value="old('etiqueta_ident')" required />
                </div>

                <div class="mt-2">
                    <x-label for="limite_neg" :value="__('Limite Neg')" />
                    <x-input id="limite_neg" class="mt-1" type="text" name="limite_neg" :value="old('limite_neg')" required />
                </div>
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Criar') }}
                </x-primary-button>
                <x-primary-button class="ml-4" href="{{ route('freezers') }}">
                    {{ __('Voltar') }}
                </x-primary-button>
            </div>
        </form>
    </section>
</x-app-layout>
