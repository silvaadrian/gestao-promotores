@extends('layouts.app')

@section('titulo', 'Promotores')

@section('conteudo')
<h1>Promotores</h1>

<a href="{{ route('promotores.create') }}">Novo promotor</a>

@if (session('sucesso'))
<p class="sucesso">{{ session('sucesso') }}</p>
@endif

@if ($promotores->isEmpty())
<p>Nenhum promotor cadastrado.</p>
@else
<table>
  <thead>
    <tr>
      <th>Nome</th>
      <th>E-mail</th>
      <th>Telefone</th>
      <th>Status</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($promotores as $promotor)
    <tr>
      <td>{{ $promotor->nome }}</td>
      <td>{{ $promotor->email ?: '—' }}</td>
      <td>{{ $promotor->telefone ?: '—' }}</td>
      <td>{{ $promotor->ativo ? 'Ativo' : 'Inativo' }}</td>
      <td><a href="{{ route('promotores.edit', $promotor) }}">Editar</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif
@endsection