<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questao extends Model
{
    use HasFactory;

    protected $table = 'questoes';

    protected $fillable = [
        'prova_id',
        'descricao',
    ];

    public function prova() {
        return $this->belongsTo(Prova::class);
    }

    public function alternativas() {
        return $this->hasMany(Alternativa::class);
    }

    public function respostas() {
        return $this->hasMany(Resposta::class);
    }
}
