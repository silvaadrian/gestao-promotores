@extends('layouts.app')

@section('titulo', 'Editar promotor')

@section('conteudo')
<h1>Editar promotor</h1>

<a href="{{ route('promotores.index') }}">Voltar para a lista</a>

<form action="{{ route('promotores.update', $promotor) }}" method="POST">
  @csrf
  @method('PUT')

  @include('promotores._formulario', ['promotor' => $promotor])

  <button type="submit">Salvar alterações</button>
</form>
@endsection