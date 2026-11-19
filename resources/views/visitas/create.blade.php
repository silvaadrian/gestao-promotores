@extends('layouts.app')

@section('titulo', 'Nova visita')

@section('conteudo')
<h1>Nova visita</h1>

<a href="{{ route('visitas.index') }}">Voltar para a lista</a>

<form action="{{ route('visitas.create') }}" method="GET">
  <label for="cliente_id_sugestao">Consultar sugestão por cliente</label>

  <select id="cliente_id_sugestao" name="cliente_id">
    <option value="">Selecione um cliente</option>
    @foreach ($clientes as $cliente)
    <option
      value="{{ $cliente->id }}"
      @selected(request('cliente_id')==$cliente->id)
      >
      {{ $cliente->nome }}
    </option>
    @endforeach
  </select>

  <button type="submit">Sugerir promotor</button>
</form>

@error('cliente_id')
<p class="erro">{{ $message }}</p>
@enderror

@if ($clienteSelecionadoId)
@if ($sugestao)
<p>
  Sugestão: <strong>{{ $sugestao['promotor']->nome }}</strong>.
  Apoio: {{ $sugestao['apoio_percentual'] }}%,
  com {{ $sugestao['registros_semelhantes'] }} visita(s) semelhante(s).
</p>

@if ($sugestao['evidencias'] !== [])
<p>Registros usados como evidência:</p>
<ul>
  @foreach ($sugestao['evidencias'] as $evidencia)
  <li>{{ $evidencia['descricao'] }}</li>
  @endforeach
</ul>
@endif
@else
<p>Não há histórico suficiente para sugerir um promotor para este cliente.</p>
@endif
@endif

<form action="{{ route('visitas.store') }}" method="POST">
  @csrf

  @include('visitas._formulario', [
  'visita' => null,
  'promotorSugeridoId' => $promotorSugeridoId,
  'clienteSelecionadoId' => $clienteSelecionadoId,
  ])

  <button type="submit">Salvar visita</button>
</form>
@endsection