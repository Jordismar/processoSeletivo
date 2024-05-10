<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vestibular') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="mt-6 space-y-6">
                        @csrf
                        <div class="grid grid-cols-12 gap-x-6 gap-y-8">
                            <div class="col-span-4">
                                <x-input-label for="nome" :value="__('Nome Candidato')" />
                                <x-text-input class="uppercase w-full" name="nome" id="nome" disabled value="{{$user->name}}"></x-text-input>
                            </div>
                            <div class="col-span-4">
                                <x-input-label for="cpf" :value="__('CPF')" />
                                <x-text-input class="uppercase w-full" name="cpf" id="cpf" disabled value="{{$aluno->cpf}}"></x-text-input>
                            </div>
                            <div class="col-span-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input class="uppercase w-full" name="email" id="email" disabled value="{{$user->email}}"></x-text-input>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-6 gap-y-8">
                            <div class="col-span-3">
                                <x-input-label for="telefone" :value="__('Telefone')" />
                                <x-text-input class="uppercase w-full" name="telefone" id="telefone" disabled value="{{$aluno->telefone}}"></x-text-input>
                            </div>
                            <div class="col-span-3">
                                <x-input-label for="escolaridade_id" :value="__('Nivel de Escolaridade')" />
                                <select name="escolaridade_id" id="escolaridade_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="" selected>Selecione</option>
                                    @foreach($escolaridades as $escolaridade)
                                        <option value="{{$escolaridade->id}}">{{$escolaridade->descricao}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-3" hidden id="div_enem">
                                <x-input-label for="enem" :value="__('Fez enem nos ultimos anos?')" />
                                <select name="enem" id="enem" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="" selected>Selecione</option>
                                    <option value="1">SIM</option>
                                    <option value="2">NÃO</option>
                                </select>
                            </div>
                            <div class="col-span-3" hidden id="div_nota">
                                <x-input-label for="nota_enem" :value="__('Qual foi sua nota?')" />
                                <x-text-input name="nota_enem" class="w-full" id="nota_enem" type="number"></x-text-input>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="{{ asset('js/vestibular/index.js') }}"></script>
