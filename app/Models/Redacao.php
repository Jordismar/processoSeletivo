<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redacao extends Model
{
    use HasFactory;

    protected $table = 'redacoes';

    protected $fillable = [
        'aluno_id',
        'conteudo',
        'arquivo',
    ];

    public function aluno() {
        return $this->belongsTo(Aluno::class);
    }
}
