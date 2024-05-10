<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cadastro Provas') }}
        </h2>
    </x-slot>
    <form method="post" action="{{ route('provas.store') }}" class="mt-4" x-data="dataProva()">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-12 gap-x-6 gap-y-8">
                        <div class="col-span-4">
                            <x-input-label for="prova_nome" :value="__('Nome da Prova')"/>
                            <x-text-input id="prova_nome" name="prova_nome" class="mt-1 w-full" x-model="nome_prova"/>
                        </div>
                        <div class="col-span-2">
                            <x-input-label for="ativada" :value="__('Usar prova?')"/>
                            <select x-model="ativada" name="ativada" id="ativada" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                                <option value="0" selected>NÃO</option>
                                <option value="1">SIM</option>
                            </select>
                        </div>
                        <div class="col-span-6">
                            <x-input-label for="informacoes" :value="__('Informações Prova')"/>
                            <x-text-input id="informacoes" name="informacoes" class="mt-1 w-full" x-model="informacao_prova"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <template x-for="(questao, index) in questoes" :key="index">
                <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="grid grid-cols-12 gap-x-6 gap-y-8">
                                <div class="col-span-12">
                                    <x-input-label for="descricao" :value="__('Enunciado da Questão:')"/>
                                    <x-text-input id="descricao" x-model="questao.descricao" class="mt-1 w-full "/>
                                </div>
                            </div>
                            <div class="mt-6 grid grid-cols-12 gap-x-6 gap-y-5">
                                <template x-for="(alternativa, altIndex) in questao.alternativas" :key="altIndex">
                                    <div class="col-span-6">
                                        <input type="checkbox" class="form-checkbox mr-3 h-4 w-4 text-green-500" x-model="alternativa.correta" x-on:click="marcarUnico(questao, altIndex)">
                                        <x-text-input x-model="alternativa.descricao"
                                                      class="mt-1 w-11/12 alternativa"/>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="questoes.length < 10">
                <div class="container mt-4 text-center">
                    <x-secondary-button x-on:click="addQuestao()">
                        Adicionar Questão
                    </x-secondary-button>
                </div>
            </template>
            <div class="container mt-4 text-center">
                <x-secondary-button x-on:click="salvaProva()">
                    Cadastrar
                </x-secondary-button>
            </div>
        </div>


    </form>
</x-app-layout>
<script src="{{ asset('js/provas/cadastro.js') }}"></script>
