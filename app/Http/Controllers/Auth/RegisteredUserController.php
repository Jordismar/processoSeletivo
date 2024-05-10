<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Instituicao;
use App\Models\User;
use App\Services\AlunosServices;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create($aluno = null): View
    {
        return view('auth.register')->with(['aluno' => $aluno ?? null]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'perfil' => ['required'],
        ];

        if ($request->perfil == 'aluno') {
            $validated = array_merge($validated, ['cpf' => ['required', 'unique:alunos'], 'telefone' => ['required']]);
        }
        $request->validate($validated);

        DB::beginTransaction();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->perfil);

        event(new Registered($user));

        Auth::login($user);

        if ($request->perfil == 'aluno') {
            Aluno::create([
                'user_id' => $user->id,
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
            ]);
            DB::commit();
            return redirect(route('vestibular', absolute: false));
        }
        Instituicao::create(['user_id' => $user->id]);
        DB::commit();
        return redirect(route('dashboard', absolute: false));

    }
}
