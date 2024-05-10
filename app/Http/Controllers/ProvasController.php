<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\AlunoProva;
use App\Models\Prova;
use App\Models\User;
use App\Services\ProvasServices;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class ProvasController extends Controller
{
    private ProvasServices $provasServices;

    public function __construct(ProvasServices $provasServices)
    {
        $this->provasServices = $provasServices;
    }

    public function index()
    {
        return view('provas.index');
    }

    public function list()
    {
        return $this->provasServices->list();
    }

    public function create()
    {
        return view('provas.cadastro');
    }

    public function store(Request $request)
    {
        return $this->provasServices->store($request->all());
    }

    public function update($id)
    {
        return view('provas.update')->with(['dados' => $this->provasServices->update($id)]);
    }

    public function updated(Request $request, $id)
    {
        return $this->provasServices->updated($id, $request->all());
    }

    public function delete($id)
    {
        return $this->provasServices->delete($id);
    }

    public function ativarDesativar($prova_id)
    {
        try {
            $prova = Prova::find($prova_id);

            if ($prova->ativada) {
                $prova->ativada = false;
            } else {
                $prova_ativa = Prova::whereAtivada(1)->first();
                if ($prova_ativa) {
                    $prova_ativa->ativada = false;
                    $prova_ativa->save();
                }
                $prova->ativada = true;
            }
            $prova->save();
            return [
                'tipo' => 'success'
            ];
        } catch (\Exception $exception) {
            return [
                'tipo' => 'error',
            ];
        }
    }

    public function provaAluno($aluno_id)
    {
        $aluno = Aluno::find($aluno_id);
        $prova = AlunoProva::whereAlunoId($aluno->id)->first()->prova;
        return view('vestibular.vestibular')->with(['prova' => $prova, 'respostas' => $aluno->respostas]);
    }
}
