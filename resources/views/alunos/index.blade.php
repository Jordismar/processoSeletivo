<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Alunos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container text-center">
                        <table id="list_alunos" class="min-w-full divide-y divide-gray-700 dark:divide-gray-500">
                            <thead class="bg-gray-800 dark:bg-gray-900">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 dark:text-gray-400 uppercase tracking-wider">Aluno</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 dark:text-gray-400 uppercase tracking-wider">Escolaridade</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 dark:text-gray-400 uppercase tracking-wider">Aprovação</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 dark:text-gray-400 uppercase tracking-wider">Ação</th>
                            </tr>
                            </thead>
                            <tbody x-init="retornaAlunos()" x-data="carregaAlunos()" class="bg-gray-50 dark:bg-gray-800 divide-y divide-gray-700 dark:divide-gray-500">
                            <template x-for="aluno in alunos" :key="aluno.aluno_id">
                                <tr class="bg-white dark:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200" x-text="aluno.nome_aluno"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200" x-text="aluno.escolaridade"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200" x-text="aluno.aprovados"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        <template x-if="aluno.prova_id">
                                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded inline-block cursor-pointer"  x-on:click="visualizar(aluno.aluno_id)">
                                                <i class="far fa-eye mr-1"></i>
                                            </button>
                                        </template>
                                        <template x-if="aluno.redacao_id" >
                                            <a id="redacao" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded inline-block cursor-pointer redacao" x-on:click="gerenciaRedacoes(aluno.aluno_id)">
                                                <i class="fa-regular fa-newspaper mr-1"></i>
                                            </a>
                                        </template>
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
        </div>
    </div>
</x-app-layout>
<script src="{{ asset('js/alunos/index.js') }}"></script>
