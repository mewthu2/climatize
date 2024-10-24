<x-app-layout>
    <x-slot name="header">
        <h5 class="text-left font-semibold text-sm text-white leading-tight">
            <i class="fas fa-users"></i> {{ __('Editar Sensor') }}
        </h5>
    </x-slot>

    <section class="container mx-auto p-4">
        <form method="POST" action="{{ route('sensors.update', $sensor->id) }}">
            @csrf
            @method('PUT')

            @if (session()->has('error'))
                <span class="bg-red-100 border border-red-400 text-red-700 rounded container mb-4">{{ session()->get('error') }}</span>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <x-label class="text-white" for="cad_cliente_id" :value="__('Vincular Cliente:')" />
                    <select id="cad_cliente_id" name="cad_cliente_id" class="mt-1 w-full form-select">
                        <option value="" @if(is_null($sensor->cad_cliente_id)) selected @endif>Selecione um cliente</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" @if($sensor->cad_cliente_id == $client->id) selected @endif>
                                {{ $client->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>   

                <div>
                    <x-label class="text-white" for="id_equipamento" :value="__('ID Equipamento:')" />
                    <x-input id="id_equipamento" class="mt-1 w-full" type="text" name="id_equipamento" value="{{ $sensor->id_equipamento }}" required autofocus/>
                </div>

                <div>
                    <x-label class="text-white" for="mac_sensor" :value="__('Mac Sensor:')" />
                    <x-input id="mac_sensor" class="mt-1 w-full" type="text" name="mac_sensor" value="{{ $sensor->mac_sensor }}" disabled />
                </div>

                <div>
                    <x-label class="text-white" for="status" :value="__('Status:')" />
                    <select id="status" name="status" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="A" {{ $sensor->status == 'A' ? 'selected' : '' }}>A</option>
                        <option value="C" {{ $sensor->status == 'C' ? 'selected' : '' }}>C</option>
                        <option value="I" {{ $sensor->status == 'I' ? 'selected' : '' }}>I</option>
                    </select>
                </div>
            </div>

            <div class="p-4 bg-gray-500 rounded-lg flex items-center justify-center mt-4">
                <x-primary-button class="ml-4">
                    <i class="fas fa-save"></i>&nbsp;{{ __('Atualizar') }}
                </x-primary-button>
                <x-primary-button class="ml-4" href="{{ route('sensors') }}">
                    <i class="fas fa-undo"></i>&nbsp;{{ __('Voltar') }}
                </x-primary-button>
            </div>
        </form>
    </section>
</x-app-layout>
