<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background: #36384f !important;">
    <a href="{{ route('dashboard') }}">
        <div class="container flex ml-1 mb-2">
            <x-logo-climatize :width="100" :height="100"></x-logo-climatize>
            <span class="text-white mt-8 text-xl font-semibold">4 </span><span class="text-cyan-400 text-xl mt-8">Climatize</span></span>
        </div>  
    </a>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
