<?php

use App\Models\Alternativa;
use App\Models\Aluno;
use App\Models\Questao;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('respostas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Aluno::class)->constrained();
            $table->foreignIdFor(Questao::class)->constrained('questoes');
            $table->foreignIdFor(Alternativa::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respostas');
    }
};
