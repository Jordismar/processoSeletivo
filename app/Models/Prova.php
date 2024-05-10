<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prova extends Model
{
    use HasFactory;

    protected $fillable = [
        'instituicao_id',
        'nome',
        'informacoes',
        'ativada'
    ];

    public function instituicoes() {
        return $this->belongsTo(Instituicao::class);
    }

    public function questoes() {
        return $this->hasMany(Questao::class);
    }
}
