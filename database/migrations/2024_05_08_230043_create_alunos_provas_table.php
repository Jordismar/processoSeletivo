<?php

use App\Models\Aluno;
use App\Models\Prova;
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
        Schema::create('alunos_provas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Prova::class)->constrained();
            $table->foreignIdFor(Aluno::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos_provas');
    }
};
