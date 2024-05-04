<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cpf',
        'escolaridade_id',
        'telefone',
        'nota_enem',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function escolaridade() {
        return $this->belongsTo(Escolaridade::class);
    }

    public function respostas() {
        return $this->hasMany(Resposta::class);
    }

    public function redacoes() {
        return $this->hasMany(Redacao::class);
    }
}
