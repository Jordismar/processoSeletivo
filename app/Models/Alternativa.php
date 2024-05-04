<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternativa extends Model
{
    use HasFactory;

    protected $fillable = [
        'questao_id',
        'descricao',
        'correta'
    ];

    public function questoes() {
        return $this->belongsTo(Questao::class);
    }

    public function respostas() {
        return $this->hasMany(Resposta::class);
    }
}
