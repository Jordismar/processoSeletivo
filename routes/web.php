<?php

use App\Http\Controllers\AlunosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProvasController;
use App\Http\Controllers\RedacaoController;
use App\Http\Controllers\VestibularController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/aprovado', [VestibularController::class, 'aprovado'])->name('aprovado');
    Route::get('/matricula', [VestibularController::class, 'matricula'])->name('matricula');

    Route::prefix('provas')->group(function () {
        Route::get('/', [ProvasController::class, 'index'])->name('provas');
        Route::get('/list', [ProvasController::class, 'list'])->name('provas.list');
        Route::get('/form', [ProvasController::class, 'create'])->name('provas.form');
        Route::post('/store', [ProvasController::class, 'store'])->name('provas.store');
        Route::get('/ativa-desativa/{prova_id}', [ProvasController::class, 'ativarDesativar'])->name('provas.ativar_desativar');
        Route::get('/visualiza-prova-aluno/{aluno_id}', [ProvasController::class, 'provaAluno'])->name('provas.prova-aluno');
    });

    Route::prefix('alunos')->group(function () {
        Route::get('/', [AlunosController::class, 'index'])->name('alunos');
        Route::get('/list', [AlunosController::class, 'list'])->name('alunos.list');
    });

    Route::prefix('vestibular')->group(function () {
        Route::get('/', [VestibularController::class, 'index'])->name('vestibular');
        Route::post('/manipula', [VestibularController::class, 'manipula'])->name('vestibular.manipula');
        Route::get('/prova', [VestibularController::class, 'prova'])->name('vestibular.prova');
        Route::post('/enviar-prova', [VestibularController::class, 'enviarProva'])->name('vestibular.envia-prova');
    });

    Route::prefix('redacao')->group(function () {
        Route::get('/', [RedacaoController::class, 'index'])->name('redacao');
        Route::get('/verifica-redacao/{aluno_id}', [RedacaoController::class, 'verificaRedacao'])->name('redacao.verifica_redacao');
        Route::get('/download', [RedacaoController::class, 'download'])->name('redacao.download');
        Route::post('/upload', [RedacaoController::class, 'upload'])->name('redacao.upload');
        Route::post('/store', [RedacaoController::class, 'store'])->name('redacao.store');
    });

});

require __DIR__ . '/auth.php';
