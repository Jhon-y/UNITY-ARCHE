<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Exibe formulário de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Processa o login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            session(['user' => $user]);

            // Redireciona de acordo com o tipo
            if ($user->tipo === 'admin') {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('index'); // usuário normal vai para a index
            }
        }

        return back()->withErrors(['email' => 'Email ou senha incorretos.']);
    }


    // Exibe formulário de cadastro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Processa o cadastro
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        session(['user' => $user]);

        // ✅ Após cadastro, também vai para a index
        return redirect()->route('index')->with('success', 'Cadastro realizado com sucesso!');
    }

    // Logout
    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login')->with('success', 'Você saiu da sua conta.');
    }
}
