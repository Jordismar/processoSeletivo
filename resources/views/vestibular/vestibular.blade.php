<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Prova') }}
        </h2>
    </x-slot>

    <form class="mt-4" id="prova">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-12 text-center gap-x-6 gap-y-8">
                        <div class="col-span-12">
                            <x-input-label for="prova_nome" class="text-4xl"
                                           :value="__('Prova: ' . strtoupper($prova->nome))"/>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 text-center gap-x-6 gap-y-8">
                        <div class="col-span-12">
                            <x-input-label for="informacoes" class="text-xl"
                                           :value="__('Informações Importantes: ' . $prova->informacoes)"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach($prova->questoes as $index => $questao)
            <div class="mt-4 max-w-7xl mx-auto sm:px-6 lg:px-8 questao" data-questao-id="{{ $index }}">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="grid grid-cols-12 gap-x-6 gap-y-8">
                            <div class="col-span-12">
                                <x-input-label for="descricao" class="text-xl" :value="__($index+1 . ') ' . $questao->descricao)"/>
                                <input type="hidden" value=>
                            </div>
                        </div>
                        <div class="mt-6 grid grid-cols-12 gap-x-6 gap-y-5">
                            @foreach($questao->alternativas as $indexAlt => $alternativa)
                                <div class="col-span-12 flex items-center">
                                    <input type="checkbox" class="form-checkbox mr-3 h-4 w-4 text-green-500"
                                           id="alternativa{{ $index }}_{{ $indexAlt }}" name="alternativas[]"
                                           value="{{ $alternativa->id }}" data-questao-id="{{ $index }}"
                                        {{isset($respostas) ? 'disabled' : ''}} {{isset($respostas) && $respostas->where('alternativa_id', $alternativa->id)->first() ? 'checked' : ''}}>
                                    <x-input-label  for="alternativa{{ $index }}_{{ $indexAlt }}"
                                                   :value="__( chr(97 + $indexAlt) . ') ' . $alternativa->descricao)"  />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if(!isset($respostas))
            <div class="container mt-4 text-center">
                <x-secondary-button onclick="enviarProva()">
                    Enviar
                </x-secondary-button>
            </div>
        @endif
    </form>
</x-app-layout>
<script src="{{ asset('js/vestibular/vestibular.js') }}"></script>
