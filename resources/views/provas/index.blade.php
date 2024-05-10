<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Provas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container text-center">
                        <table id="list_provas" class="min-w-full divide-y divide-gray-700 dark:divide-gray-500">
                            <thead class="bg-gray-800 dark:bg-gray-900">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 dark:text-gray-400 uppercase tracking-wider">Data Criação</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 dark:text-gray-400 uppercase tracking-wider">Nome</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 dark:text-gray-400 uppercase tracking-wider">Instituição</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 dark:text-gray-400 uppercase tracking-wider">Ação</th>
                            </tr>
                            </thead>
                            <tbody x-init="retornaProvas()" x-data="carregaProvas()" class="bg-gray-50 dark:bg-gray-800 divide-y divide-gray-700 dark:divide-gray-500">
                            <template x-for="prova in provas" :key="prova.prova_id">
                                <tr class="bg-white dark:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200" x-text="prova.data_criacao"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200" x-text="prova.nome_prova"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200" x-text="prova.nome_instituicoes"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        <button class="bg-green-500 text-white font-bold py-1 px-3 rounded inline-block cursor-pointer"
                                                x-bind:class="{ 'bg-green-500': !prova.prova_ativada, 'bg-red-500': prova.prova_ativada }"
                                                x-on:click="ativaProva(prova.prova_id)">
                                            <i class="fa-solid" x-bind:class="{ 'fa-play': !prova.prova_ativada, 'fa-pause': prova.prova_ativada }"></i>
                                        </button>
{{--                                        <a id="redacao" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded inline-block cursor-pointer redacao" x-on:click="gerenciaRedacoes(prova.prova_id)">--}}
{{--                                            <i class="fa-regular fa-newspaper mr-1"></i>--}}
{{--                                        </a>--}}
                                    </td>
                                </tr>
                            </template>
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container text-center mt-5">
                <x-secondary-button onclick="window.location.href = '/provas/form'">
                    Cadastrar
                </x-secondary-button>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="{{ asset('js/provas/index.js') }}"></script>
