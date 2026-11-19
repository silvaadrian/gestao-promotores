@extends('layouts.app')

@section('titulo', 'Novo promotor')

@section('conteudo')
<h1>Novo promotor</h1>

<a href="{{ route('promotores.index') }}">Voltar para a lista</a>

<form action="{{ route('promotores.store') }}" method="POST">
  @csrf

  @include('promotores._formulario', ['promotor' => null])

  <p>
    <button type="submit">Salvar promotor</button>
  </p>
</form>
@endsection