<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Artisan::call('db:seed', ['--class' => 'PermissoesSeeder', '--force' => true]);

        $user = User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ]);

        $role = Role::where('name', 'admin')->first();
        $user->assignRole($role);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
