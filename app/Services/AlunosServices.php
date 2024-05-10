<?php

namespace App\Services;

use App\Models\Aluno;
use Illuminate\Support\Facades\DB;

class AlunosServices
{
    public function list()
    {
        return Aluno::select([
            'alunos.id as aluno_id',
            'users.name as nome_aluno',
            'redacoes.id as redacao_id',
            'alunos_provas.id as prova_id',
            DB::raw("if(alunos.aprovado = '1', 'APROVADO', 'NÃO APROVADO') as aprovados"),
            'escolaridades.descricao as escolaridade',
        ])  ->join('users', 'alunos.user_id', 'users.id')
            ->leftJoin('redacoes', 'alunos.id', 'redacoes.aluno_id')
            ->leftJoin('escolaridades', 'alunos.escolaridade_id', 'escolaridades.id')
            ->leftJoin('alunos_provas', 'alunos.id', 'alunos_provas.aluno_id')
            ->orderBy('alunos.aprovado', 'desc')
            ->paginate(10);
    }
}
