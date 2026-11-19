@extends('layouts.app')

@section('titulo', 'Visitas')

@section('conteudo')
<h1>Visitas</h1>

<form action="{{ route('visitas.index') }}" method="GET">
  <label for="promotor_id">Promotor</label>
  <select id="promotor_id" name="promotor_id">
    <option value="">Todos</option>
    @foreach ($promotores as $promotor)
    <option
      value="{{ $promotor->id }}"
      @selected(request('promotor_id')==$promotor->id)
      >
      {{ $promotor->nome }}
    </option>
    @endforeach
  </select>

  <label for="status">Status</label>
  <select id="status" name="status">
    <option value="">Todos</option>
    <option value="agendada" @selected(request('status')==='agendada' )>Agendada</option>
    <option value="realizada" @selected(request('status')==='realizada' )>Realizada</option>
    <option value="cancelada" @selected(request('status')==='cancelada' )>Cancelada</option>
  </select>

  <label for="data_inicio">De</label>
  <input id="data_inicio" name="data_inicio" type="date" value="{{ request('data_inicio') }}">

  <label for="data_fim">Até</label>
  <input id="data_fim" name="data_fim" type="date" value="{{ request('data_fim') }}">

  <button type="submit">Filtrar</button>
  <a href="{{ route('visitas.index') }}">Limpar</a>
</form>

<p>
  Visitas encontradas: {{ $totalVisitas }} |
  Realizadas: {{ $totalRealizadas }}
</p>

<a href="{{ route('visitas.create') }}">Nova visita</a>

@if (session('sucesso'))
<p class="sucesso">{{ session('sucesso') }}</p>
@endif

@if ($visitas->isEmpty())
<p>Nenhuma visita cadastrada.</p>
@else
<table>
  <thead>
    <tr>
      <th>Data e hora</th>
      <th>Promotor</th>
      <th>Cliente</th>
      <th>Status</th>
      <th>Observações</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($visitas as $visita)
    <tr>
      <td>{{ $visita->agendada_para->format('d/m/Y H:i') }}</td>
      <td>{{ $visita->promotor->nome }}</td>
      <td>{{ $visita->cliente->nome }}</td>
      <td>{{ ucfirst($visita->status) }}</td>
      <td>{{ $visita->observacoes ?: '—' }}</td>
      <td><a href="{{ route('visitas.edit', $visita) }}">Editar</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif
@endsection