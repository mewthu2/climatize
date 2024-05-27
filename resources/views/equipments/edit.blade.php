<x-app-layout>
  <x-slot name="header">
      <h5 class="text-left font-semibold text-sm text-white leading-tight">
          <i class="fas fa-users"></i> {{ __('Editar Equipamento') }}
      </h5>
  </x-slot>
  
  <section class="container mx-auto p-4" style="overflow-y: scroll;">
      <form method="POST" action="{{ route('equipments.update', $equipment->id) }}">
          @csrf
          @method('PUT')

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
              <div>
                  <x-label class="text-white" for="id" :value="__('ID do equipamento *')" />
                  <x-input id="id" class="mt-1 w-full" type="text" name="id" value="{{ $equipment->id }}" required autofocus />
              </div>

              <div>
                  <x-label class="text-white" for="nome" :value="__('Nome do equipamento *')" />
                  <x-input id="nome" class="mt-1 w-full" type="text" name="nome" value="{{ $equipment->nome }}" required />
              </div>

              <div>
                  <x-label class="text-white" for="descricao" :value="__('Descrição *')" />
                  <x-input id="descricao" class="mt-1 w-full" type="text" name="descricao" value="{{ $equipment->descricao }}" required />
              </div>

              <div>
                  <x-label class="text-white" for="endereco" :value="__('Endereço *')" />
                  <x-input id="endereco" class="mt-1 w-full" type="text" name="endereco" value="{{ $equipment->endereco }}" required />
              </div>
          </div>

          <div class="p-4 bg-gray-500 rounded-lg flex items-center justify-center mt-4">
              <x-primary-button class="ml-4">
                  {{ __('Atualizar') }}
              </x-primary-button>
              <x-primary-button class="ml-4" href="{{ route('equipments') }}">
                  {{ __('Voltar') }}
              </x-primary-button>
          </div>
      </form>
  </section>
</x-app-layout>
