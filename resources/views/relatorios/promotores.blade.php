@extends('layouts.app')

@section('titulo', 'Relatório de promotores')

@section('conteudo')
<h1>Relatório de promotores</h1>

<form action="{{ route('relatorios.promotores') }}" method="GET">
  <label for="data_inicial">Data inicial</label>
  <input
    id="data_inicial"
    name="data_inicial"
    type="date"
    value="{{ old('data_inicial', $dataInicial) }}">

  @error('data_inicial')
  <p class="erro">{{ $message }}</p>
  @enderror

  <label for="data_final">Data final</label>
  <input
    id="data_final"
    name="data_final"
    type="date"
    value="{{ old('data_final', $dataFinal) }}">

  @error('data_final')
  <p class="erro">{{ $message }}</p>
  @enderror

  <button type="submit">Filtrar período</button>
  <a href="{{ route('relatorios.promotores') }}">Limpar</a>
</form>
<p>
  <a href="{{ route(
    'relatorios.promotores.exportar',
    request()->only(['data_inicial', 'data_final'])
  ) }}">
    Baixar relatório em CSV
  </a>
</p>

@if ($promotores->isEmpty())
<p>Nenhum promotor cadastrado.</p>
@else
<table>
  <thead>
    <tr>
      <th>Promotor</th>
      <th>Situação</th>
      <th>Agendadas</th>
      <th>Realizadas</th>
      <th>Canceladas</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($promotores as $promotor)
    <tr>
      <td>{{ $promotor->nome }}</td>
      <td>{{ $promotor->ativo ? 'Ativo' : 'Inativo' }}</td>
      <td>{{ $promotor->visitas_agendadas }}</td>
      <td>{{ $promotor->visitas_realizadas }}</td>
      <td>{{ $promotor->visitas_canceladas }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif

<p>
  <a href="{{ route('painel') }}">Voltar ao painel</a>
</p>
@endsection