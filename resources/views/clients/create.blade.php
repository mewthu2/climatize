<x-app-layout>
    <x-slot name="header">
        <h5 class="text-left font-semibold text-sm text-white leading-tight">
            <i class="fas fa-users"></i> {{ __('Novo Cliente') }}
        </h5>
    </x-slot>
  
    <section class="container mx-auto p-4" style="overflow-y: scroll;">
        <form method="POST" action="{{ route('clients.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <x-label class="text-white" for="nome" :value="__('Nome *')" />
                    <x-input id="nome" class="mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus />
                </div>

                <div>
                    <x-label class="text-white" for="cpf" :value="__('CPF *')" />
                    <x-input id="cpf" class="mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required />
                </div>

                <div>
                    <x-label class="text-white" for="cnpj" :value="__('CNPJ *')" />
                    <x-input id="cnpj" class="mt-1 w-full" type="text" name="cnpj" :value="old('cnpj')" required />
                </div>

                <div>
                    <x-label class="text-white" for="inscricao_estadual" :value="__('Inscrição Estadual *')" />
                    <x-input id="inscricao_estadual" class="mt-1 w-full" type="text" name="inscricao_estadual" :value="old('inscricao_estadual')" required />
                </div>

                <div>
                    <x-label class="text-white" for="tipo" :value="__('Tipo *')" />
                    <x-input id="tipo" class="mt-1 w-full" type="text" name="tipo" :value="old('tipo')" required />
                </div>

                <div>
                    <x-label class="text-white" for="endereco" :value="__('Endereço *')" />
                    <x-input id="endereco" class="mt-1 w-full" type="text" name="endereco" :value="old('endereco')" required />
                </div>

                <div>
                    <x-label class="text-white" for="numero" :value="__('Número *')" />
                    <x-input id="numero" class="mt-1 w-full" type="text" name="numero" :value="old('numero')" required />
                </div>

                <div>
                    <x-label class="text-white" for="complemento" :value="__('Complemento *')" />
                    <x-input id="complemento" class="mt-1 w-full" type="text" name="complemento" :value="old('complemento')" required />
                </div>

                <div>
                    <x-label class="text-white" for="bairro" :value="__('Bairro *')" />
                    <x-input id="bairro" class="mt-1 w-full" type="text" name="bairro" :value="old('bairro')" required />
                </div>

                <div>
                    <x-label class="text-white" for="cidade" :value="__('Cidade *')" />
                    <x-input id="cidade" class="mt-1 w-full" type="text" name="cidade" :value="old('cidade')" required />
                </div>

                <div>
                    <x-label class="text-white" for="estado" :value="__('Estado *')" />
                    <x-input id="estado" class="mt-1 w-full" type="text" name="estado" :value="old('estado')" required />
                </div>

                <div>
                    <x-label class="text-white" for="cep" :value="__('CEP *')" />
                    <x-input id="cep" class="mt-1 w-full" type="text" name="cep" :value="old('cep')" required />
                </div>

                <div>
                    <x-label class="text-white" for="telefone" :value="__('Telefone *')" />
                    <x-input id="telefone" class="mt-1 w-full" type="text" name="telefone" :value="old('telefone')" required />
                </div>

                <div>
                    <x-label class="text-white" for="celular" :value="__('Celular *')" />
                    <x-input id="celular" class="mt-1 w-full" type="text" name="celular" :value="old('celular')" required />
                </div>

                <div>
                    <x-label class="text-white" for="email" :value="__('Email *')" />
                    <x-input id="email" class="mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>

                <div>
                    <x-label class="text-white" for="observacao" :value="__('Observação *')" />
                    <x-input id="observacao" class="mt-1 w-full" type="text" name="observacao" :value="old('observacao')" required />
                </div>

                <div>
                    <x-label class="text-white" for="descricao" :value="__('Descrição *')" />
                    <x-input id="descricao" class="mt-1 w-full" type="text" name="descricao" :value="old('descricao')" required />
                </div>

                <div>
                    <x-label class="text-white" for="matriz_id" :value="__('Matriz ID *')" />
                    <x-input id="matriz_id" class="mt-1 w-full"
                    type="text" name="matriz_id" :value="old('matriz_id')" required />
                </div>
            </div>

            <div class="p-4 bg-gray-500 rounded-lg flex items-center justify-center mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Criar') }}
                </x-primary-button>
                <x-primary-button class="ml-4" href="{{ route('clients') }}">
                    {{ __('Voltar') }}
                </x-primary-button>
            </div>
        </form>
    </section>
</x-app-layout>

