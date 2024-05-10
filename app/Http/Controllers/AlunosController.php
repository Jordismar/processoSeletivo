<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AlunosServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlunosController extends Controller
{
    private AlunosServices $alunosServices;
    public function __construct(AlunosServices $alunosServices)
    {
        $this->alunosServices = $alunosServices;
    }

    public function index()
    {
        return view('alunos.index');
    }

    public function list()
    {
        return $this->alunosServices->list();
    }
}
