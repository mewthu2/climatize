<x-app-layout>
    <x-slot name="header">
        <h5 class="text-left font-semibold text-sm text-white leading-tight">
            <i class="fas fa-users"></i> {{ __('Listagem de Usuários') }}
            <x-primary-button class="ml-4" href="{{ route('users.create') }}">
                <i class="fas fa-plus"></i> {{ __('Novo') }}
            </x-primary-button>

            @if(session()->has('success'))
                <span 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 6000)" 
                    x-show="show" 
                    x-transition:leave="transition ease-in duration-3000" 
                    x-transition:leave-start="opacity-100" 
                    x-transition:leave-end="opacity-0"
                    class="ml-4 p-2 bg-blue-100 border border-blue-400 text-blue-700 rounded" 
                    role="alert"
                >
                    <span>{{ session()->get('success') }}</span>
                </span>
            @elseif(session()->has('error'))
                <span 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 6000)" 
                    x-show="show" 
                    x-transition:leave="transition ease-in duration-3000" 
                    x-transition:leave-start="opacity-100" 
                    x-transition:leave-end="opacity-0"
                    class="ml-4 p-2 bg-red-100 border border-red-400 text-red-700 rounded" 
                    role="alert"
                >
                    <span>{{ session()->get('error') }}</span>
                </span>
            @endif
        </h5>
    </x-slot>


    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="inset-y-0 start-0 flex items-center ps-3 pointer-events-none max-w-md mx-auto mb-2 mt-1">

        </div>
        <div></div>
        <div></div>
        <div>
            <form method="GET" action="{{ route('users') }}" class="max-w-md mx-auto mb-2 mt-1 mr-4">   
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" name="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pesquisar usuários..." />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Pesquisar</button>
                </div>
            </form>
        </div>
    </div>


    <div class="mr-4 ml-4 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th width="50" class="text-center"><i class="fa fa-ellipsis-v"></i></th>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Nome</th>
                    <th scope="col" class="px-6 py-3">E-mail</th>
                    <th scope="col" class="px-6 py-3">E-mail verificado</th>
                    <th scope="col" class="px-6 py-3">Data de Criação</th>
                    <th scope="col" class="px-6 py-3">Última Atualização</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td class="px-6 py-4 flex">
                            <a href="{{ route('users.edit', $user->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                            <a href="{{ route('users.destroy', $user->id) }}" class="font-medium text-red-600 dark:text-red-500 hover:underline ml-2">Excluir</a>
                        </td>
                        <td class="px-6 py-4">{{ $user->id }}</td>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ $user->email_verified_at ? 'Sim' : 'Não' }}</td>
                        <td class="px-6 py-4">{{ $user->created_at }}</td>
                        <td class="px-6 py-4">{{ $user->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
