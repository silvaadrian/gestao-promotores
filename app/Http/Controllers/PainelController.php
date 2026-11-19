<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Promotor;
use App\Models\Visita;
use Illuminate\View\View;

final class PainelController extends Controller
{
    public function index(): View
    {
        $agora = now();

        $proximasVisitas = Visita::query()
            ->with(['promotor', 'cliente'])
            ->where('status', 'agendada')
            ->where('agendada_para', '>=', $agora)
            ->orderBy('agendada_para')
            ->limit(5)
            ->get();

        return view('painel.index', [
            'totalPromotores' => Promotor::query()
                ->where('ativo', true)
                ->count(),

            'totalClientes' => Cliente::query()
                ->where('ativo', true)
                ->count(),

            'totalVisitasAgendadas' => Visita::query()
                ->where('status', 'agendada')
                ->where('agendada_para', '>=', $agora)
                ->count(),

            'totalVisitasRealizadas' => Visita::query()
                ->where('status', 'realizada')
                ->count(),

            'proximasVisitas' => $proximasVisitas,
        ]);
    }
}
