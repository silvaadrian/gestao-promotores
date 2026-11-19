@extends('layouts.app')

@section('titulo', 'Criar conta')

@section('conteudo')
<h1>Criar conta</h1>

<form action="{{ route('cadastro.salvar') }}" method="POST">
  @csrf

  <label for="nome">Nome</label>
  <input
    id="nome"
    name="nome"
    type="text"
    value="{{ old('nome') }}"
    maxlength="255"
    required>
  @error('nome')
  <p class="erro">{{ $message }}</p>
  @enderror

  <label for="email">E-mail</label>
  <input
    id="email"
    name="email"
    type="email"
    value="{{ old('email') }}"
    maxlength="255"
    required>
  @error('email')
  <p class="erro">{{ $message }}</p>
  @enderror

  <label for="senha">Senha</label>
  <input id="senha" name="senha" type="password" minlength="8" required>
  @error('senha')
  <p class="erro">{{ $message }}</p>
  @enderror

  <label for="senha_confirmation">Confirme a senha</label>
  <input
    id="senha_confirmation"
    name="senha_confirmation"
    type="password"
    minlength="8"
    required>

  <p>
    <button type="submit">Criar conta</button>
  </p>
</form>

<p>
  Já tem uma conta?
  <a href="{{ route('login') }}">Entrar</a>
</p>
@endsection