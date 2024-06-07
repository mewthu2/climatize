<x-app-layout>
    <x-slot name="header">
        <h5 class="text-left font-semibold text-sm text-white leading-tight">
            <i class="fas fa-tachometer-alt"></i> {{ __('Painel Geral de Monitoramento') }}
        </h5>
    </x-slot>
    
    <div class="py-2 px-2 whitespace-normal grid lg:grid-cols-4 gap-1 sm:grid-cols-1">
        @foreach($painels as $painel)
            <div class="mb-2 mx-auto sm:px-2 lg:px-2">
                <div class="overflow-hidden shadow-xl sm:rounded-lg" style="background: #c7caeb;">
                    <div class="p-2">
                        <div class="max-w-lg">
                            <div class="text-center rounded-lg" style="background: #36384f;">
                                <h5 class="mb-2 text-sm font-xs tracking-tight text-gray-500 dark:text-white">{{ $painel->etiqueta_ident }} <span style="font-size: 12px !important;"><i class="far fa-clock"></i>  {{ $painel->dt_leitura }} </span>
                                    @if($painel->estaEmDegelo)
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Em degelo</span>
                                    @endif
                                </h5>
                            </div>
                            <div class="grid grid-cols-3 gap-1 mt-2 text-center">
                                <div class="text-xs text-center rounded-lg m-1 p-1 shadow-lg bg-white max-w-xs">
                                    <span class="text-blue-600">
                                        <b>Unidade:</b> {{ $painel->nome_unidade }} 
                                    </span>
                                </div>

                                <div class="text-xs text-center rounded-lg m-1 p-1 shadow-lg bg-white max-w-xs">
                                    <span class="text-blue-600">
                                        <b>Referência:</b> {{ $painel->referencia }} 
                                    </span>
                                </div>
        
                                <div class="text-xs text-center rounded-lg p-1 m-1 shadow-lg bg-white max-w-xs">
                                    <span class="text-blue-600">
                                        <b>Detalhe:</b> {{ $painel->detalhe }} 
                                    </span>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-1 mt-2 text-center">
                                <div class="text-x rounded-lg p-2 shadow-lg @if ($painel->atu < $painel->min || $painel->atu > $painel->max || $painel->estaEmDegelo = false) bg-red-800 @else bg-blue-200 @endif">
                                    <span class="@if ($painel->atu < $painel->min || $painel->atu > $painel->max || $painel->estaEmDegelo = false) text-yellow-400 animate-pulse @else text-green-800 @endif text-x break-all">
                                        {{ $painel->atu }} C°
                                    </span>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-3 mt-2 text-center">
                                <span class="text-dark flex text-xs">
                                    <svg class="w-4 h-4 animate-pulse text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                                    </svg>
                                    <span class="m-1">{{ $painel->setpoint }} C°</span>
                                </span>
        
                                <span class="text-dark flex text-xs">
                                    <svg class="w-4 h-4 animate-pulse text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 5.25 7.5 7.5 7.5-7.5m-15 6 7.5 7.5 7.5-7.5" />
                                    </svg>
                                    <span class="m-1">{{ $painel->min }} C°</span>
                                </span>
                                
                                <span class="text-dark flex text-xs">
                                    <svg class="w-4 h-4 animate-pulse mt-1 text-red-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 18.75 7.5-7.5 7.5 7.5" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <span class="m-1">{{ $painel->max }} C°</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
