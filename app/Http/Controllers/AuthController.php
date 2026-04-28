<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password; // Importante para as novas regras

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
        ]);
    }

    /**
     * MÉTODO DE LOGOUT CORRIGIDO
     */
    public function logout(Request $request)
    {
        // 1. Limpa especificamente o carrinho da sessão
        $request->session()->forget('cart');

        // 2. Desloga o usuário do sistema
        Auth::logout();

        // 3. Destrói a sessão atual do navegador
        $request->session()->invalidate();

        // 4. Gera um novo token CSRF para evitar ataques de segurança
        $request->session()->regenerateToken();

        // 5. Redireciona para a home (ou login)
        return redirect('/');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                // Novas regras de segurança:
                Password::min(8) // Mínimo de 8 caracteres
                    ->mixedCase() // Pelo menos uma letra maiúscula e uma minúscula
                    ->symbols()   // Pelo menos um caractere especial (!@#$%...)
                    ->uncompromised(), // Opcional: Verifica se a senha já vazou na internet (segurança extra)
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect('/');
    }
}
