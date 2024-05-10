<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alternativa;
use App\Models\Aluno;
use App\Models\AlunoProva;
use App\Models\Escolaridade;
use App\Models\Prova;
use App\Models\Questao;
use App\Models\Resposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VestibularController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $aluno = $user->aluno;

        $data = [
            'escolaridades' => Escolaridade::all(),
            'aluno' => $aluno,
            'user' => $user
        ];
        return view('vestibular.index')->with($data);
    }

    public function manipula(Request $request)
    {
        $aluno = Auth::user()->aluno;

        $aluno->escolaridade_id = $request->escolaridade_id ?? null;
        $aluno->nota_enem = $request->nota_enem ?? null;
        $aluno->save();

        if (in_array($request->opcao, ['aprovado', 'matricula'])) {
            $aluno->aprovado = 1;
            $aluno->save();

            return ['url' => $request->opcao == 'aprovado' ? '/aprovado' : '/matricula'];
        } elseif($request->opcao == 'redacao') {
            return ['url' => '/redacao/'];
        } else {
            return ['url' => '/vestibular/prova'];
        }
    }

    public function matricula()
    {
        return view('vestibular.matricula');
    }

    public function aprovado()
    {
        return view('vestibular.aprovado');
    }

    public function prova()
    {
        return view('vestibular.vestibular')->with(['prova' => Prova::with(['questoes.alternativas'])->whereAtivada(1)->first()]);
    }

    public function enviarProva(Request $request)
    {
        try {
            $data = $request->all();

            $aluno = Auth::user()->aluno;
            $respostas_certas = 0;
            $count = count($data);

            foreach ($data as $alternativa) {
                $alter = Alternativa::find($alternativa);
                Resposta::create([
                    'alternativa_id' => $alternativa,
                    'questao_id' => $alter->questao_id,
                    'aluno_id' => $aluno->id,
                ]);
                if ($alter->correta) {
                    $respostas_certas++;
                }
            }
            $porcentagem_corretas = ($respostas_certas / $count) * 100;

            if ($porcentagem_corretas > 60) {
                $aluno->aprovado = 1;
                $aluno->save();
            }

            AlunoProva::create([
                'aluno_id' => $aluno->id,
                'prova_id' => $aluno->respostas[0]->questao->prova_id
            ]);
            return [
                'tipo' => 'success',
                'aprovado' => $aluno->aprovado
            ];
        } catch (\Exception $exception) {
            return ['tipo' => 'error'];
        }
    }
}
