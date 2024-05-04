<?php

namespace Database\Seeders;

use App\Models\Escolaridade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscolaridadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
          ['id' => 1, 'descricao' => 'Ensino Médio Completo'],
          ['id' => 2, 'descricao' => 'Ensino Superior Completo'],
          ['id' => 3, 'descricao' => 'Ensino Superior Incompleto'],
        ];

        foreach ($datas as $data) {
            $existe = DB::table('escolaridades')
                ->where('id', $data['id'])
                ->where('descricao', $data['descricao'])
                ->exists();

            if (! $existe) {
                DB::table('escolaridades')->insert($data);
            }
        }
    }
}
