<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class PermissoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ['name' => 'instituicao', 'guard_name' => 'web'],
            ['name' => 'aluno', 'guard_name' => 'web'],
            ['name' => 'admin', 'guard_name' => 'web'],
        ];

        foreach ($datas as $data) {
            $existe = DB::table('roles')
                ->where('name', $data['name'])
                ->exists();

            if (! $existe) {
                DB::table('roles')->insert($data);
            }
        }
    }
}
