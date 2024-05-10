<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlunoProva extends Model
{
    use HasFactory;

    protected $table = 'alunos_provas';

    protected $fillable = [
        'prova_id',
        'aluno_id'
    ];

    public function aluno() {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    public function prova() {
        return $this->belongsTo(Prova::class, 'prova_id');
    }
}
