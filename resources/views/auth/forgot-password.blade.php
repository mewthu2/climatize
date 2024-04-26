<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="container flex items-center">
                <x-logo-climatize class="mr-4" :width="200" :height="200"></x-logo-climatize>
            </div>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos para você um link de redefinição de senha por e-mail, que permitirá que você escolha uma nova.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Link de Redefinição de Senha por E-mail') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
