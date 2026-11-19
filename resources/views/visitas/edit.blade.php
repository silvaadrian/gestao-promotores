@extends('layouts.app')

@section('titulo', 'Editar visita')

@section('conteudo')
<h1>Editar visita</h1>

<a href="{{ route('visitas.index') }}">Voltar para a lista</a>

<form action="{{ route('visitas.update', $visita) }}" method="POST">
  @csrf
  @method('PUT')

  @include('visitas._formulario', ['visita' => $visita])

  <button type="submit">Salvar alterações</button>
</form>
@endsection