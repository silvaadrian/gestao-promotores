<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalvarVisitaRequest;
use App\Http\Requests\FiltrarVisitasRequest;
use App\Services\SugestaoPromotorService;
use App\Models\Cliente;
use App\Models\Promotor;
use App\Models\Visita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitaController extends Controller
{
    public function index(FiltrarVisitasRequest $requisicao): View
    {
        $filtros = $requisicao->validated();

        $consulta = Visita::query()
            ->with(['promotor', 'cliente']);

        if (!empty($filtros['promotor_id'])) {
            $consulta->where('promotor_id', $filtros['promotor_id']);
        }

        if (!empty($filtros['status'])) {
            $consulta->where('status', $filtros['status']);
        }

        if (!empty($filtros['data_inicio'])) {
            $consulta->whereDate('agendada_para', '>=', $filtros['data_inicio']);
        }

        if (!empty($filtros['data_fim'])) {
            $consulta->whereDate('agendada_para', '<=', $filtros['data_fim']);
        }

        $visitas = $consulta
            ->orderBy('agendada_para')
            ->get();

        $promotores = Promotor::query()
            ->orderBy('nome')
            ->get();

        $totalVisitas = $visitas->count();
        $totalRealizadas = $visitas->where('status', 'realizada')->count();

        return view(
            'visitas.index',
            compact('visitas', 'promotores', 'totalVisitas', 'totalRealizadas')
        );
    }

    public function create(
        Request $requisicao,
        SugestaoPromotorService $servicoSugestao
    ): View {
        $filtros = $requisicao->validate([
            'cliente_id' => ['nullable', 'integer', 'exists:clientes,id'],
        ]);

        $promotores = Promotor::query()
            ->where('ativo', true)
            ->orderBy('nome')
            ->get();

        $clientes = Cliente::query()
            ->where('ativo', true)
            ->orderBy('nome')
            ->get();

        $clienteSelecionadoId = $filtros['cliente_id'] ?? null;
        $clienteSelecionado = $clienteSelecionadoId
            ? Cliente::query()->find($clienteSelecionadoId)
            : null;

        $sugestao = $clienteSelecionado
            ? $servicoSugestao->sugerir($clienteSelecionado)
            : null;

        $promotorSugeridoId = $sugestao['promotor']->id ?? null;

        return view(
            'visitas.create',
            compact(
                'promotores',
                'clientes',
                'clienteSelecionadoId',
                'sugestao',
                'promotorSugeridoId'
            )
        );
    }

    public function store(SalvarVisitaRequest $requisicao): RedirectResponse
    {
        Visita::create($requisicao->validated());

        return redirect()
            ->route('visitas.index')
            ->with('sucesso', 'Visita cadastrada com sucesso.');
    }

    public function edit(Visita $visita): View
    {
        $promotores = Promotor::query()
            ->orderBy('nome')
            ->get();

        $clientes = Cliente::query()
            ->orderBy('nome')
            ->get();

        return view(
            'visitas.edit',
            compact('visita', 'promotores', 'clientes')
        );
    }

    public function update(
        SalvarVisitaRequest $requisicao,
        Visita $visita
    ): RedirectResponse {
        $visita->update($requisicao->validated());

        return redirect()
            ->route('visitas.index')
            ->with('sucesso', 'Visita atualizada com sucesso.');
    }
}
