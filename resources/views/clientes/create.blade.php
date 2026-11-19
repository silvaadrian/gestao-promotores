@extends('layouts.app')

@section('titulo', 'Novo cliente')

@section('conteudo')
<h1>Novo cliente</h1>

<a href="{{ route('clientes.index') }}">Voltar para a lista</a>

<form action="{{ route('clientes.store') }}" method="POST">
  @csrf

  <label for="nome">Nome</label>
  <input
    id="nome"
    name="nome"
    type="text"
    value="{{ old('nome') }}"
    maxlength="120"
    required>
  @error('nome')
  <p class="erro">{{ $message }}</p>
  @enderror

  <label for="cidade">Cidade</label>
  <input
    id="cidade"
    name="cidade"
    type="text"
    value="{{ old('cidade') }}"
    maxlength="100"
    required>
  @error('cidade')
  <p class="erro">{{ $message }}</p>
  @enderror

  <label for="estado">Estado (UF)</label>
  <input
    id="estado"
    name="estado"
    type="text"
    value="{{ old('estado') }}"
    maxlength="2"
    required>
  @error('estado')
  <p class="erro">{{ $message }}</p>
  @enderror

  <label for="endereco">Endereço</label>
  <input
    id="endereco"
    name="endereco"
    type="text"
    value="{{ old('endereco') }}"
    maxlength="255">
  @error('endereco')
  <p class="erro">{{ $message }}</p>
  @enderror

  <p>
    <button type="submit">Salvar cliente</button>
  </p>
</form>
@endsection