@extends('layouts.app')

@section('titulo', 'Entrar')

@section('conteudo')
<h1>Entrar</h1>

<form action="{{ route('login.autenticar') }}" method="POST">
  @csrf

  <label for="email">E-mail</label>
  <input
    id="email"
    name="email"
    type="email"
    value="{{ old('email') }}"
    required>
  @error('email')
  <p class="erro">{{ $message }}</p>
  @enderror

  <label for="senha">Senha</label>
  <input id="senha" name="senha" type="password" required>
  @error('senha')
  <p class="erro">{{ $message }}</p>
  @enderror

  <p>
    <button type="submit">Entrar</button>
  </p>
</form>

<p>
  Ainda não tem conta?
  <a href="{{ route('cadastro') }}">Cadastre-se</a>
</p>
@endsection