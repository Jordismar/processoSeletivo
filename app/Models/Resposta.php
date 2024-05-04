<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'questao_id',
        'alternativa_id',
    ];

    public function aluno() {
        return $this->belongsTo(Aluno::class);
    }

    public function questao() {
        return $this->belongsTo(Questao::class);
    }

    public function alternativa() {
        return $this->belongsTo(Alternativa::class);
    }
}
