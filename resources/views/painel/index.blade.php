@extends('layouts.app')

@section('titulo', 'Painel')

@section('conteudo')
<h1>Painel</h1>

<section>
  <h2>Resumo</h2>

  <ul>
    <li>Promotores ativos: {{ $totalPromotores }}</li>
    <li>Clientes ativos: {{ $totalClientes }}</li>
    <li>Visitas agendadas: {{ $totalVisitasAgendadas }}</li>
    <li>Visitas realizadas: {{ $totalVisitasRealizadas }}</li>
  </ul>
</section>

<section>
  <h2>Próximas visitas</h2>

  @forelse ($proximasVisitas as $visita)
  <article>
    <p>
      <strong>Data:</strong>
      {{ $visita->agendada_para->format('d/m/Y H:i') }}
    </p>
    <p><strong>Promotor:</strong> {{ $visita->promotor->nome }}</p>
    <p><strong>Cliente:</strong> {{ $visita->cliente->nome }}</p>
    <a href="{{ route('visitas.edit', $visita) }}">Editar visita</a>
  </article>
  @empty
  <p>Não há visitas futuras agendadas.</p>
  @endforelse

  <a href="{{ route('visitas.index') }}">Ver todas as visitas</a>
</section>
@endsection