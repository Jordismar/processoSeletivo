<?php

namespace Database\Factories;

use App\Models\Aluno;
use App\Models\Escolaridade;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AlunoFactory extends Factory
{
    protected $model = Aluno::class;

    public function definition(): array
    {
        return [
            'cpf' => $this->faker->word(),
            'telefone' => $this->faker->word(),
            'nota_enem' => $this->faker->randomNumber(),
            'aprovado' => $this->faker->boolean(),
            'user_id' => User::factory(),
            'escolaridade_id' => Escolaridade::inRandomOrder()->first()->id,
        ];
    }
}
