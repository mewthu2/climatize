<x-app-layout>
  <x-slot name="header">
      <h5 class="text-left font-semibold text-sm text-white leading-tight">
          <i class="fas fa-users"></i> {{ __('Listagem de contatos') }}
      </h5>
  </x-slot>

  <section class="container mx-auto p-2 font-mono" style="overflow-y: scroll;">
      <div class="w-full mb-8 rounded-lg shadow-lg" style="overflow-y: scroll;">
          <div class="w-full" style="overflow-y: scroll;">
              <table class="w-full overflow-x-auto border-collapse border border-gray-300">
                  <thead>
                      <tr class="text-sm font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                          <th class="px-6 py-3 border border-gray-300">ID</th>
                          <th class="px-6 py-3 border border-gray-300">Nome</th>
                          <th class="px-6 py-3 border border-gray-300">Telefone</th>
                          <th class="px-6 py-3 border border-gray-300">Email</th>
                          <th class="px-6 py-3 border border-gray-300">Nível de Escalonamento</th>
                          <th class="px-6 py-3 border border-gray-300">Endereço</th>
                          <th class="px-6 py-3 border border-gray-300">Bairro</th>
                          <th class="px-6 py-3 border border-gray-300">Cidade</th>
                          <th class="px-6 py-3 border border-gray-300">Estado</th>
                          <th class="px-6 py-3 border border-gray-300">Ações</th>
                      </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                      @foreach ($contatos as $contato)
                      <tr>
                          <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $contato->id }}</td>
                          <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $contato->nome }}</td>
                          <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $contato->telefone }}</td>
                          <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $contato->email }}</td>
                          <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $contato->nivel_escalonamento }}</td>
                          <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $contato->endereco }}</td>
                          <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $contato->bairro }}</td>
                          <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $contato->cidade }}</td>
                          <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300">{{ $contato->estado }}</td>
                          <td class="px-6 lg:whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6 border border-gray-300"><!-- Ações --></td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </section>
</x-app-layout>
