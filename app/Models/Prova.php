<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prova extends Model
{
    use HasFactory;

    protected $fillable = [
        'professor_id',
        'nome',
        'informacoes',
    ];

    public function professor() {
        return $this->belongsTo(Professor::class);
    }
}
