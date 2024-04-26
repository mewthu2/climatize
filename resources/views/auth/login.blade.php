<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="container flex items-center">
                <x-logo-climatize class="mr-4" :width="200" :height="200"></x-logo-climatize>
            </div>
            <span class="bg-blue-100 text-blue-800 text-2xl px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 flex items-center justify-center">4 Climatize</span>
            <span class="ms-2 text-sm text-gray-600 px-2.5">Painel de Gerenciamento</span>
        </x-slot>        

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Senha') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Lembrar-me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Esqueceu sua senha?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Logar') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
