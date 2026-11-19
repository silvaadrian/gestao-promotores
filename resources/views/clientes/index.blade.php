@extends('layouts.app')

@section('titulo', 'Clientes')

@section('conteudo')
<h1>Clientes</h1>

<a href="{{ route('clientes.create') }}">Novo cliente</a>

@if (session('sucesso'))
<p class="sucesso">{{ session('sucesso') }}</p>
@endif

@if ($clientes->isEmpty())
<p>Nenhum cliente cadastrado.</p>
@else
<table>
  <thead>
    <tr>
      <th>Nome</th>
      <th>Cidade</th>
      <th>Estado</th>
      <th>Endereço</th>
      <th>Status</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($clientes as $cliente)
    <tr>
      <td>{{ $cliente->nome }}</td>
      <td>{{ $cliente->cidade }}</td>
      <td>{{ $cliente->estado }}</td>
      <td>{{ $cliente->endereco ?: '—' }}</td>
      <td>{{ $cliente->ativo ? 'Ativo' : 'Inativo' }}</td>
      <td>
        <a href="{{ route('clientes.edit', $cliente) }}">Editar</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif
@endsection