<x-app-layout>
    <x-slot name="header">
        <h5 class="text-left font-semibold text-sm text-white leading-tight">
            <i class="fas fa-tachometer-alt"></i> {{ __('Painel Geral de Monitoramento') }}
        </h5>
    </x-slot>
    <section class="container mx-auto py-2 px-2 rounded-lg grid lg:grid-cols-4 gap-1 sm:grid-cols-1">
        @foreach($freezers as $freezer)
            <div class="mb-2 mx-auto sm:px-2 lg:px-2">
                <div class="p-2 border rounded-t-xl border-gray-600 bg-gray-600">
                    <div class="grid grid-cols-1">
                      
                    <div class="items-center justify-center col-span-1 space-x-2 flex">
                        <button class="flex items-center justify-center w-9 h-9 text-xs font-medium rounded-lg toggle-full-view focus:z-10 focus:ring-2 bg-gray-800 focus:outline-none text-gray-400 border-gray-600 hover:text-white hover:bg-gray-700">
                            <i class="fa fa-chart-simple"></i>
                        </button>
                        
                        <button class="flex items-center justify-center w-9 h-9 text-xs font-medium rounded-lg toggle-tablet-view focus:z-10 focus:ring-2 bg-gray-800 focus:outline-none text-gray-400 border-gray-600 hover:text-white">
                            <a href="{{ route('freezers.edit', ['id' => $freezer->id]) }}" target="_blank">
                                <i class="fa fa-gear"></i>
                            </a>                                                                                
                        </button>

                        <button  class="flex items-center justify-center w-9 h-9 text-xs font-medium rounded-lg toggle-mobile-view focus:z-10 focus:ring-2 bg-gray-800 focus:outline-none text-gray-400 border-gray-600 hover:text-white hover:bg-gray-700">
                            <i class="fa fa-bell"></i>
                         </button>
                      
                      </div>
                 
                    </div>
                </div>
                <div class="overflow-hidden shadow-lg bg-gray-600">
                    <div class="p-2">
                        <div class="max-w-lg">
                            <div class="text-center rounded-lg" style="background: #36384f;">
                                <h5 class="mb-2 text-sm font-xs tracking-tight text-green-600">{{ $freezer->etiqueta_ident }} <span class="text-gray-200" style="font-size: 12px !important;"><i class="far fa-clock"></i>  {{ $freezer->dt_leitura }} </span>
                                    @if($freezer->estaEmDegelo)
                                        <span class="text-xs font-medium me-2 px-2.5 py-0.5 rounded bg-blue-900 text-blue-300">Em degelo</span>
                                    @endif
                                </h5>
                            </div>
                            <div class="grid grid-cols-3 gap-1 mt-2 text-center">
                                <div class="text-xs text-center rounded-lg m-1 p-1 shadow-lg bg-white max-w-xs">
                                    <span class="text-blue-600">
                                        <b>Unidade:</b> {{ $freezer->nome_unidade }} 
                                    </span>
                                </div>

                                <div class="text-xs text-center rounded-lg m-1 p-1 shadow-lg bg-white max-w-xs">
                                    <span class="text-blue-600">
                                        <b>Referência:</b> {{ $freezer->referencia }} 
                                    </span>
                                </div>
        
                                <div class="text-xs text-center rounded-lg p-1 m-1 shadow-lg bg-white max-w-xs">
                                    <span class="text-blue-600">
                                        <b>Detalhe:</b> {{ $freezer->detalhe }} 
                                    </span>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-1 mt-2 text-center">
                                <div class="text-x rounded-lg p-2 shadow-lg @if ($freezer->atu < $freezer->limite_neg || $freezer->atu > $freezer->limite_pos || $freezer->estaEmDegelo = false) bg-red-800 @else bg-blue-200 @endif">
                                    <span class="@if ($freezer->atu < $freezer->limite_neg || $freezer->atu > $freezer->limite_pos || $freezer->estaEmDegelo = false) text-yellow-400 animate-pulse @else text-green-800 @endif text-x break-all">
                                        {{ $freezer->atu }} C°
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2 border rounded-b-xl border-gray-600 bg-gray-600">
                    <div class="grid grid-cols-3 gap-3 mt-2 text-center set-temp-col">
                        <span class="text-dark flex text-xs">
                            <svg class="w-4 h-4 animate-pulse text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                            </svg>
                            <span class="m-1 text-white">{{ $freezer->setpoint }} C°</span>
                        </span>

                        <span class="text-dark flex text-xs">
                            <svg class="w-4 h-4 animate-pulse text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 5.25 7.5 7.5 7.5-7.5m-15 6 7.5 7.5 7.5-7.5" />
                            </svg>
                            <span class="m-1 text-white">{{ $freezer->limite_neg }} C°</span>
                        </span>
                        
                        <span class="text-dark flex text-xs">
                            <svg class="w-4 h-4 animate-pulse mt-1 text-red-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 18.75 7.5-7.5 7.5 7.5" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 7.5-7.5 7.5 7.5" />
                            </svg>
                            <span class="m-1 text-white">{{ $freezer->limite_pos }} C°</span>
                        </span>
                    </div>
                </div>
            </div>
            
        @endforeach
    </section>
</x-app-layout>

<style>
    .buttons-div{
        display: flex;
        flex-wrap: nowrap;
        justify-content: center;
    }
    .set-temp-col{
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
    }
</style>
