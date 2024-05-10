<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        @if(isset($aluno))
            <div class="mt-4">
                <x-input-label for="cpf" :value="__('CPF')" />
                <x-text-input id="cpf" maxlength="11" class="block mt-1 w-full" type="text" name="cpf" required/>
                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="telefone" :value="__('Telefone')" />
                <x-text-input id="telefone" maxlength="11" class="block mt-1 w-full" type="text" name="telefone" required/>
                <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
            </div>
        @endif

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirme a Senha')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <x-text-input type="hidden" name="perfil" value="{{isset($aluno) ? 'aluno' : 'instituicao'}}"/>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Já possui registro?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<script >
    $(document).ready(function(){
        $('#cpf').mask('000.000.000-00', {reverse: true});
        $('#telefone').mask('(00) 00000-0000');
    })
</script>
