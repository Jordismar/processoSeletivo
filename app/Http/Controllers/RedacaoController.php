<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Redacao;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RedacaoController extends Controller
{
    public function index()
    {
        return view('redacao.index');
    }

    public function upload(Request $request)
    {
        try {
            $data = $request->all();
            $aluno = Auth::user()->aluno;

            $path = Storage::putFile('redacoes', $data['file']);

            DB::beginTransaction();

            $aluno->aprovado = 1;
            $aluno->save();

            Redacao::create([
                'aluno_id' => $aluno->id,
                'arquivo' => $path
            ]);
            DB::commit();
            return ['tipo' => 'sucesso'];
        } catch (Exception $exception) {
            DB::rollBack();
            return [
                'tipo' => 'error',
                'message' => $exception->getMessage()
            ];
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $aluno = Auth::user()->aluno;

            DB::beginTransaction();

            $aluno->aprovado = 1;
            $aluno->save();

            Redacao::create([
                'aluno_id' => $aluno->id,
                'conteudo' => $data['redacao']
            ]);
            DB::commit();
            return ['tipo' => 'sucesso'];
        } catch (Exception $exception) {
            DB::rollBack();
            return [
                'tipo' => 'error',
                'message' => $exception->getMessage()
            ];
        }
    }

    public function verificaRedacao($aluno_id)
    {
        $redacao = Redacao::whereAlunoId($aluno_id)->first();

        return [
            'url' => $redacao->arquivo ?? null,
            'conteudo' => $redacao->conteudo ?? null,
        ];
    }

    public function download(Request $request)
    {
        if (!Storage::exists($request->url)) {
            abort(404);
        }

        return Storage::download($request->url);
    }
}
