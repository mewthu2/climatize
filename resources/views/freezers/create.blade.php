<x-app-layout>
    <x-slot name="header">
        <h5 class="text-left font-semibold text-sm text-white leading-tight">
            <i class="fas fa-users"></i> {{ __('Novo Freezer') }}
        </h5>
    </x-slot>

    <form method="POST" action="{{ route('freezers.store') }}">
        @csrf

        <div class="mt-4">
            <x-label for="id_equipamento" :value="__('ID do Equipamento')" />
            <x-input id="id_equipamento" class="block mt-1 w-full" type="text" name="id_equipamento" :value="old('id_equipamento')" required autofocus />
        </div>

        <div class="mt-4">
            <x-label for="mac_sensor" :value="__('Mac Sensor')" />
            <x-input id="mac_sensor" class="block mt-1 w-full" type="text" name="mac_sensor" :value="old('mac_sensor')" required />
        </div>

        <div class="mt-4">
            <x-label for="nome_unidade" :value="__('Nome Unidade')" />
            <x-input id="nome_unidade" class="block mt-1 w-full" type="text" name="nome_unidade" :value="old('nome_unidade')" required />
        </div>

        <div class="mt-4">
            <x-label for="referencia" :value="__('Referência')" />
            <x-input id="referencia" class="block mt-1 w-full" type="text" name="referencia" :value="old('referencia')" required />
        </div>

        <div class="mt-4">
            <x-label for="detalhe" :value="__('Detalhe')" />
            <x-input id="detalhe" class="block mt-1 w-full" type="text" name="detalhe" :value="old('detalhe')" required />
        </div>

        <div class="mt-4">
            <x-label for="setpoint" :value="__('Setpoint')" />
            <x-input id="setpoint" class="block mt-1 w-full" type="text" name="setpoint" :value="old('setpoint')" required />
        </div>

        <div class="mt-4">
            <x-label for="etiqueta_ident" :value="__('Etiqueta Ident')" />
            <x-input id="etiqueta_ident" class="block mt-1 w-full" type="text" name="etiqueta_ident" :value="old('etiqueta_ident')" required />
        </div>

        <div class="mt-4">
            <x-label for="limite_neg" :value="__('Limite Neg')" />
            <x-input id="limite_neg" class="block mt-1 w-full" type="text" name="limite_neg" :value="old('limite_neg')" required />
        </div>

        <div class="mt-4">
            <x-label for="limite_pos" :value="__('Limite Pos')" />
            <x-input id="limite_pos" class="block mt-1 w-full" type="text" name="limite_pos" :value="old('limite_pos')" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                {{ __('Criar') }}
            </button>
        </div>
    </form>
</x-app-layout>
