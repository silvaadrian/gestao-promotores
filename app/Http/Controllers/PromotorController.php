<?php

namespace App\Http\Controllers;

use App\Models\Promotor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\CadastrarPromotorRequest;
use App\Http\Requests\AtualizarPromotorRequest;

class PromotorController extends Controller
{
    public function index(): View
    {
        $promotores = Promotor::query()
            ->orderBy('nome')
            ->get();

        return view('promotores.index', compact('promotores'));
    }

    public function create(): View
    {
        return view('promotores.create');
    }

    public function store(CadastrarPromotorRequest $requisicao): RedirectResponse
    {
        Promotor::create($requisicao->validated());

        return redirect()
            ->route('promotores.index')
            ->with('sucesso', 'Promotor cadastrado com sucesso.');
    }

    public function edit(Promotor $promotor): View
    {
        return view('promotores.edit', compact('promotor'));
    }

    public function update(
        AtualizarPromotorRequest $requisicao,
        Promotor $promotor
    ): RedirectResponse {
        $dados = $requisicao->validated();
        $dados['ativo'] = (bool) $dados['ativo'];

        $promotor->update($dados);

        return redirect()
            ->route('promotores.index')
            ->with('sucesso', 'Promotor atualizado com sucesso.');
    }
}
