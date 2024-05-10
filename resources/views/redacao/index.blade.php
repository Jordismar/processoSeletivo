<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Redação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="mt-6 space-y-6">
                        @csrf
                        <div class="container text-center">
                            <x-secondary-button id="redigir">
                                Redigir Redação
                            </x-secondary-button>

                            <x-secondary-button id="upload">
                                Upload Redação
                            </x-secondary-button>
                        </div>
                        <textarea id="editor" hidden class="redigi_editor"></textarea>
                        <div class="container text-center redigi_editor" hidden>
                            <x-secondary-button id="store">
                                Salvar
                            </x-secondary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="{{ asset('js/redacao/index.js') }}"></script>
