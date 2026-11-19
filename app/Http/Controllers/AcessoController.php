<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AcessoController extends Controller
{
    public function mostrarLogin(): View
    {
        return view('autenticacao.entrar');
    }

    public function autenticar(Request $requisicao): RedirectResponse
    {
        $dados = $requisicao->validate(
            [
                'email' => ['required', 'email'],
                'senha' => ['required', 'string'],
            ],
            [
                'email.required' => 'Informe seu e-mail.',
                'email.email' => 'Informe um e-mail válido.',
                'senha.required' => 'Informe sua senha.',
            ]
        );

        $credenciais = [
            'email' => $dados['email'],
            'password' => $dados['senha'],
        ];

        if (Auth::attempt($credenciais)) {
            $requisicao->session()->regenerate();

            return redirect()->intended(route('promotores.index'));
        }

        return back()
            ->withErrors(['email' => 'E-mail ou senha inválidos.'])
            ->onlyInput('email');
    }

    public function mostrarCadastro(): View
    {
        return view('autenticacao.cadastrar');
    }

    public function cadastrar(Request $requisicao): RedirectResponse
    {
        $dados = $requisicao->validate(
            [
                'nome' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'senha' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'nome.required' => 'Informe seu nome.',
                'email.required' => 'Informe seu e-mail.',
                'email.email' => 'Informe um e-mail válido.',
                'email.unique' => 'Este e-mail já está cadastrado.',
                'senha.required' => 'Informe uma senha.',
                'senha.min' => 'A senha deve ter pelo menos :min caracteres.',
                'senha.confirmed' => 'A confirmação da senha não corresponde.',
            ]
        );

        $usuario = User::create([
            'name' => $dados['nome'],
            'email' => $dados['email'],
            'password' => Hash::make($dados['senha']),
        ]);

        Auth::login($usuario);
        $requisicao->session()->regenerate();

        return redirect()->intended(route('promotores.index'));
    }

    public function sair(Request $requisicao): RedirectResponse
    {
        Auth::logout();

        $requisicao->session()->invalidate();
        $requisicao->session()->regenerateToken();

        return redirect()->route('login');
    }
}
