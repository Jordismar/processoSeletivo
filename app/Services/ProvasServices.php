<?php

namespace App\Services;

use App\Models\Alternativa;
use App\Models\Prova;
use App\Models\Questao;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProvasServices
{
    public function list()
    {
        return Prova::select([
            DB::raw("date_format(provas.created_at, '%d/%m/%Y %H:%i') as data_criacao"),
            'provas.nome as nome_prova',
            'users.name as nome_instituicoes',
            'provas.id as prova_id',
            'provas.ativada as prova_ativada',
        ])
            ->join('instituicoes', 'provas.instituicao_id', 'instituicoes.id')
            ->join('users', 'instituicoes.user_id', 'users.id')->paginate(100);
    }

    public function store(array $dados): array
    {
        try {
            DB::beginTransaction();

            $dados['instituicao_id'] = Auth::user()->instituicao->id;

            $prova = Prova::create([
                'nome' => $dados['nome_prova'],
                'instituicao_id' => $dados['instituicao_id'],
                'informacoes' => $dados['informacao_prova'],
                'ativada' => $dados['ativada'],
            ]);

            $valida = $this->gerenciaQuestoes($dados['questoes'], $prova->id);

            if ($valida) {
                return [
                    'erro' => $valida->getMessage(),
                    'mensagem' => 'Erro ao cadastrar prova',
                    'tipo' => 'error'
                ];
            }

            DB::commit();

            return [
                'tipo' => 'success',
                'mensagem' => 'Prova cadastrado com sucesso!'
            ];
        } catch (Exception $exception) {
            return [
                'erro' => $exception->getMessage(),
                'mensagem' => 'Erro ao cadastrar prova',
                'tipo' => 'error'
            ];
        }
    }

    public function update($id)
    {
        return Prova::with(['questoes.alternativa'])->find($id);
    }

    public function updated($id, $dados): array
    {
        try {
            $this->deleteDependencias($id);

            $this->gerenciaQuestoes($dados['questoes'], $id);

            return [
                'tipo' => 'success',
                'mensagem' => 'Prova atualizada com sucesso!'
            ];
        } catch (Exception $exception) {
            return [
                'erro' => $exception->getMessage(),
                'mensagem' => 'Erro ao atualizar prova',
                'tipo' => 'error'
            ];
        }
    }

    public function delete($id): array
    {
        try {
            DB::beginTransaction();
            $this->deleteDependencias($id);

            Prova::find($id)->delete();

            DB::commit();

            return [
                'tipo' => 'success',
                'mensagem' => 'Prova removida com sucesso!'
            ];
        } catch (Exception $exception) {
            return [
                'erro' => $exception->getMessage(),
                'mensagem' => 'Erro ao deletar prova',
                'tipo' => 'error'
            ];
        }
    }

    private function gerenciaQuestoes(mixed $questoes, $prova_id)
    {
        try {
            foreach ($questoes as $questao) {
                $questao_save = Questao::create(['descricao' => $questao['descricao'], 'prova_id' => $prova_id]);

                foreach ($questao['alternativas'] as $alternativa) {
                    Alternativa::create([
                        'descricao' => $alternativa['descricao'],
                        'questao_id' => $questao_save->id,
                        'correta' => $alternativa['correta']
                    ]);
                }
            }
        } catch (Exception $exception) {
            return $exception;
        }
    }

    private function deleteDependencias($id): void
    {
        $questoes = Questao::whereProvaId($id)->get();

        foreach ($questoes as $questao) {
            $alternativas = Alternativa::whereQuestaoId($questao->id)->get();
            foreach ($alternativas as $alternativa) {
                $alternativa->delete();
            }
            $questao->delete();
        }
    }
}
