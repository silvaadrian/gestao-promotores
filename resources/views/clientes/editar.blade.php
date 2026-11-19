@extends('layouts.app')

@section('titulo', 'Editar cliente')

@section('conteudo')
<h1>Editar cliente</h1>

<a href="{{ route('clientes.index') }}">Voltar para a lista</a>

<form action="{{ route('clientes.update', $cliente) }}" method="POST">
  @csrf
  @method('PUT')

  <label for="nome">Nome</label>
  <input
    id="nome"
    name="nome"
    value="{{ old('nome', $cliente->nome) }}"
    required>
  @error('nome')
  <p class="erro">{{ $message }}</p>
  @enderror

  <label for="cidade">Cidade</label>
  <input
    id="cidade"
    name="cidade"
    value="{{ old('cidade', $cliente->cidade) }}"
    required>
  @error('cidade')
  <p class="erro">{{ $message }}</p>
  @enderror

  <label for="estado">UF</label>
  <input
    id="estado"
    name="estado"
    value="{{ old('estado', $cliente->estado) }}"
    maxlength="2"
    required>
  @error('estado')
  <p class="erro">{{ $message }}</p>
  @enderror

  <label for="endereco">Endereço</label>
  <input
    id="endereco"
    name="endereco"
    value="{{ old('endereco', $cliente->endereco) }}">
  @error('endereco')
  <p class="erro">{{ $message }}</p>
  @enderror

  <input type="hidden" name="ativo" value="0">
  <label>
    <input
      type="checkbox"
      name="ativo"
      value="1"
      @checked(old('ativo', $cliente->ativo))>
    Cliente ativo
  </label>
  @error('ativo')
  <p class="erro">{{ $message }}</p>
  @enderror

  <button type="submit">Salvar alterações</button>
</form>
@endsection